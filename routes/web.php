<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataStatistikController;
use Illuminate\Support\Facades\Route;

// 1. Redirect Halaman Depan ke Login
Route::get('/', function () {
    // Cek: Kalau user sudah login, lempar ke beranda. Kalau belum, ke login.
    if (auth()->check()) {
        return redirect()->route('beranda');
    }
    return redirect()->route('login');
});

// 2. GROUP ROUTE YANG BUTUH LOGIN (Halaman Admin/User)
Route::middleware('auth')->group(function () {
    
    Route::get('/beranda', fn() => view('pages.beranda'))->name('beranda');
    Route::get('/peta', fn() => view('pages.peta'))->name('peta');
    Route::get('/data-statistik', [DataStatistikController::class, 'index'])->name('data-statistik');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

}); // <--- PERHATIKAN! Tanda kurung kurawal TUTUP middleware ada di sini.

// 3. LOAD ROUTE AUTH (Login, Register, dll)
// INI WAJIB DI LUAR KURUNG KURAWAL DI ATAS
require __DIR__.'/auth.php';