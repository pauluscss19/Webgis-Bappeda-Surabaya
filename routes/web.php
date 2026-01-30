<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn () => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {

  $request->validate(
    [
      'username' => ['required'],
      'password' => ['required'],
    ],
    [
      'required' => '*silahkan isi dengan lengkap!',
    ]
  );

  if ($request->username === 'admin' && $request->password === 'admin123') {
    return redirect('/beranda');
  }

  return back()->withErrors(['login' => '*paswword atau username salah!'])->withInput();
});



Route::get('/beranda', fn () => view('pages.beranda'))->name('beranda');

Route::get('/peta', fn() => view('pages.peta'))->name('peta');

Route::get('/data-statistik', fn() => view('pages.data-statistik'))->name('data-statistik');