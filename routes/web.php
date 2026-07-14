<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/', function () {
    return view('welcome');
});

// AREA WAJIB LOGIN
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Logika Pengarah (Redirect) Berdasarkan Role
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'operator') {
            // Nanti kita buat rute operator, sementara arahin ke dashboard biasa
            return view('dashboard');
        }
        return view('dashboard'); // Untuk Warga
    })->name('dashboard');

    // RUTE KHUSUS ADMIN (CMS ala WordPress)
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'admin') abort(403, 'Akses Ditolak. Halaman ini khusus Admin.');
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Rute Web Warga
    Route::get('/pemetaan', [MapController::class, 'index'])->name('pemetaan');
    Route::get('/faq', function () { return view('faq'); })->name('faq');
    Route::get('/tambah-faq', function () { return view('tambah-faq'); })->name('faq.tambah');
    Route::get('/laporan-web', function () { return view('laporan-web'); })->name('laporan-web');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';