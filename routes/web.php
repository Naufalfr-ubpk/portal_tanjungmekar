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

// AREA PROTEKSI (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pemetaan', [MapController::class, 'index'])->name('pemetaan');
    
    Route::get('/faq', function () {
        return view('faq');
    })->name('faq');

    // HALAMAN BARU SESUAI REQUEST
    Route::get('/tambah-faq', function () {
        return view('tambah-faq');
    })->name('faq.tambah');

    Route::get('/laporan-web', function () {
        return view('laporan-web');
    })->name('laporan-web');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';