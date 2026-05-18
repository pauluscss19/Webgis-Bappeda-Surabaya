<?php

use App\Http\Controllers\GeoLayerController;
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
