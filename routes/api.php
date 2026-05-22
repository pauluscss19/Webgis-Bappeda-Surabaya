<?php

use App\Http\Controllers\GeoLayerController;
use App\Http\Controllers\CustomLayerController;
use App\Http\Controllers\DemografiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Route untuk menyajikan data GeoJSON dari database.
| Prefix: /api
*/

// Daftar semua layer yang tersedia
Route::get('/geo-layers', [GeoLayerController::class, 'index']);

// Ambil data GeoJSON untuk satu layer
Route::get('/geo-layer/{layerKey}', [GeoLayerController::class, 'show']);

// Pencarian fitur dalam satu layer
Route::get('/geo-layer/{layerKey}/search', [GeoLayerController::class, 'search']);

// Daftar custom layers aktif (untuk sidebar peta)
Route::get('/custom-layers', [CustomLayerController::class, 'apiIndex']);

// Data Demografi per Kelurahan (untuk MCE / Analisis Kesesuaian Lahan)
Route::get('/demografi', [DemografiController::class, 'index']);
Route::get('/demografi/detail', [DemografiController::class, 'detail']);
