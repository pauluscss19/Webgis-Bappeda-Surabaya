<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjiAirController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Badan Air (41 Titik)
        $badanAir = DB::table('uji_air_badan_air')->orderBy('id', 'asc')->get();

        // 2. Ambil Data Kawasan Pelabuhan
        $pelabuhan = DB::table('uji_air_laut_pelabuhan')->orderBy('id', 'asc')->get();

        // 3. Ambil Data Wisata Bahari
        $wisata = DB::table('uji_air_laut_wisata_bahari')->orderBy('id', 'asc')->get();

        // 4. Ambil Data Biota Laut
        $biota = DB::table('uji_air_laut_biota_laut')->orderBy('id', 'asc')->get();

        return view('pages.uji-air', compact('badanAir', 'pelabuhan', 'wisata', 'biota'));
    }
}