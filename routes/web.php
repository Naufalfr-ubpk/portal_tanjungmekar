<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PemetaanController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Auth;
use App\Models\Location; 
use App\Models\Faq;

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/', function () {
    $faqs = Faq::where('is_bawaan', true)
               ->orWhere('is_bawaan', 1)
               ->orWhere('is_bawaan', '1')
               ->orderBy('pertanyaan', 'asc')
               ->take(3)
               ->get();

    return view('welcome', compact('faqs'));
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
        if (Auth::user()->role === 'operator') return redirect()->route('operator.dashboard');
        return view('dashboard');
    })->name('dashboard');

    // 1. MURNI KHUSUS ADMIN (Hanya Dashboard Admin)
    Route::prefix('admin')->middleware('can:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // 2. BISA DIAKSES ADMIN & OPERATOR (Manajemen Peta, FAQ, & DATA WARGA)
    Route::prefix('admin')->middleware('can:operator')->group(function () {
        Route::get('/pemetaan', [PemetaanController::class, 'index'])->name('admin.pemetaan.index');
        Route::post('/pemetaan', [PemetaanController::class, 'store'])->name('admin.pemetaan.store');
        Route::put('/pemetaan/{id}', [PemetaanController::class, 'update'])->name('admin.pemetaan.update');
        Route::delete('/pemetaan/{id}', [PemetaanController::class, 'destroy'])->name('admin.pemetaan.destroy');

        Route::get('/manajemen-faq', [\App\Http\Controllers\Admin\FaqAdminController::class, 'index'])->name('admin.faq.index');
        Route::put('/manajemen-faq/{id}', [\App\Http\Controllers\Admin\FaqAdminController::class, 'update'])->name('admin.faq.update');
        Route::delete('/manajemen-faq/{id}', [\App\Http\Controllers\Admin\FaqAdminController::class, 'destroy'])->name('admin.faq.destroy');

        Route::get('/manajemen-faq/web', [\App\Http\Controllers\Admin\FaqAdminController::class, 'bawaanIndex'])->name('admin.faq.bawaan');
        Route::post('/manajemen-faq/web', [\App\Http\Controllers\Admin\FaqAdminController::class, 'bawaanStore'])->name('admin.faq.bawaan.store');
        Route::put('/manajemen-faq/web/{id}', [\App\Http\Controllers\Admin\FaqAdminController::class, 'bawaanUpdate'])->name('admin.faq.bawaan.update');
        Route::delete('/manajemen-faq/web/{id}', [\App\Http\Controllers\Admin\FaqAdminController::class, 'bawaanDestroy'])->name('admin.faq.bawaan.destroy');

        // ROUTE DATA WARGA
        Route::get('/data-warga', [\App\Http\Controllers\Admin\DataWargaController::class, 'index'])->name('admin.data-warga.index');
        Route::delete('/data-warga/{id}', [\App\Http\Controllers\Admin\DataWargaController::class, 'destroy'])->name('admin.data-warga.destroy');

        // ROUTE BANK SAMPAH
        Route::get('/bank-sampah', [\App\Http\Controllers\Admin\BankSampahController::class, 'index'])->name('admin.bank-sampah.index');

        Route::post('/bank-sampah/kategori', [\App\Http\Controllers\Admin\BankSampahController::class, 'storeKategori'])->name('admin.bank-sampah.kategori.store');
        Route::post('/bank-sampah/transaksi', [\App\Http\Controllers\Admin\BankSampahController::class, 'storeTransaksi'])->name('admin.bank-sampah.transaksi.store');

        Route::delete('/bank-sampah/kategori/{id}', [\App\Http\Controllers\Admin\BankSampahController::class, 'destroyKategori'])->name('admin.bank-sampah.kategori.destroy');
        Route::delete('/bank-sampah/transaksi/{id}', [\App\Http\Controllers\Admin\BankSampahController::class, 'destroyTransaksi'])->name('admin.bank-sampah.transaksi.destroy');

    });

    // 3. KHUSUS OPERATOR
    Route::prefix('operator')->middleware('can:operator')->group(function () {
        Route::get('/dashboard', function () {
            return view('operator.dashboard');
        })->name('operator.dashboard');
    });

    Route::get('/pemetaan', function () { 
        $locations = Location::orderByRaw("FIELD(type, 'kelurahan', 'rw', 'banksampah')")
                             ->orderBy('title', 'asc')
                             ->get();
        return view('pemetaan.index', compact('locations')); 
    })->name('pemetaan');
    
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/tambah-faq', [FaqController::class, 'create'])->name('faq.tambah');
    Route::post('/tambah-faq', [FaqController::class, 'store'])->name('faq.store');
    
    Route::get('/laporan-web', function () { return view('laporan-web'); })->name('laporan-web');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});

require __DIR__.'/auth.php';