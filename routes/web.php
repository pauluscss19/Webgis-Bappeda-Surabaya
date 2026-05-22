<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataStatistikController;
use App\Http\Controllers\UjiAirController;
use App\Http\Controllers\UjiUdaraController;
use App\Http\Controllers\RthController;
use App\Http\Controllers\DataSampahController;
use App\Http\Controllers\DataKualitasLingkunganController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\RthCrudController;
use App\Http\Controllers\CustomLayerController;
use App\Http\Controllers\RingkasanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CaptchaHelper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Route untuk generate gambar CAPTCHA (sebelum route auth)
Route::get('/captcha-image', function () {
    return response(CaptchaHelper::createImage())
        ->header('Content-Type', 'image/png')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache');
})->name('captcha.image');

// 1. ROUTE HALAMAN DEPAN (Redirect Logic)
Route::get('/', function () {
    // Jika User sudah login, langsung lempar ke Beranda
    if (Auth::check()) {
        return redirect()->route('beranda');
    }
    // Jika belum, lempar ke halaman Login
    return redirect()->route('login');
});


// 2. GROUP ROUTE YANG BUTUH LOGIN (Halaman Admin/User)
Route::middleware('auth')->group(function () {

    Route::get('/beranda', fn() => view('pages.beranda'))->name('beranda');
    Route::get('/peta', fn() => view('pages.peta'))->name('peta');
    Route::get('/data-statistik', [DataStatistikController::class, 'index'])->name('data-statistik');
    Route::get('/rth-surabaya', [RthController::class, 'index'])->name('rth-surabaya');

    // --- CRUD Data Sampah ---
    Route::resource('data-sampah', DataSampahController::class);

    // --- CRUD Data Kualitas Lingkungan ---
    Route::resource('kualitas-lingkungan', DataKualitasLingkunganController::class);

    // --- CRUD Sarana & Prasarana ---
    Route::resource('sarpras', SarprasController::class);

    // --- CRUD RTH ---
    Route::resource('rth', RthCrudController::class);

    Route::resource('custom-layers', CustomLayerController::class);
    Route::patch('custom-layers/{custom_layer}/toggle', [CustomLayerController::class, 'toggle'])->name('custom-layers.toggle');
    Route::post('custom-layers/{custom_layer}/add-point', [CustomLayerController::class, 'addPoint'])->name('custom-layers.add-point');
    Route::put('custom-layers/{custom_layer}/features/{feature_id}', [CustomLayerController::class, 'updateFeature'])->name('custom-layers.update-feature');
    Route::delete('custom-layers/{custom_layer}/features/{feature_id}', [CustomLayerController::class, 'deleteFeature'])->name('custom-layers.delete-feature');

    // --- Ringkasan ---
    Route::get('/ringkasan', [RingkasanController::class, 'index'])->name('ringkasan');
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

    // --- CRUD Data Sampah ---
    Route::resource('data-sampah', DataSampahController::class);

    // --- CRUD Data Kualitas Lingkungan ---
    Route::resource('kualitas-lingkungan', DataKualitasLingkunganController::class);

    // --- Profile User (Bawaan Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. LOAD ROUTE AUTHENTICATION
require __DIR__ . '/auth.php';
