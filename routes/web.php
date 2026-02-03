<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataStatistikController; // ✅ Pastikan Controller ini di-import
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. ROUTE HALAMAN DEPAN (Redirect Logic)
Route::get('/', function () {
    // Jika User sudah login, langsung lempar ke Beranda
    if (Auth::check()) {
        return redirect()->route('beranda');
    }
    // Jika belum, lempar ke halaman Login
    return redirect()->route('login');
});

// 2. GROUP ROUTE YANG BUTUH LOGIN (Middleware 'auth')
Route::middleware(['auth', 'verified'])->group(function () {

    // --- Dashboard & Menu Utama ---
    // Pastikan file: resources/views/pages/beranda.blade.php ADA
    Route::get('/beranda', function () {
        return view('pages.beranda');
    })->name('beranda');

    // Pastikan file: resources/views/pages/peta.blade.php ADA
    Route::get('/peta', function () {
        return view('pages.peta');
    })->name('peta');

    // --- Controller Data Statistik (Chart) ---
    // Saya ubah name-nya jadi 'data.statistik' (pakai titik) biar standar Laravel
    Route::get('/data-statistik', [DataStatistikController::class, 'index'])->name('data.statistik');

    // --- Profile User (Bawaan Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. LOAD ROUTE AUTHENTICATION
require __DIR__ . '/auth.php';
