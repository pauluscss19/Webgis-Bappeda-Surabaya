<?php

use Illuminate\Support\Facades\Route;

Route::get('/peta', function () {
    return view('peta');
});

Route::get('/login-sby', function () {
    return view('auth.login-sby');
})->name('login.sby');


Route::get('/beranda', fn () => view('pages.beranda'))->name('beranda');