<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataStatistikController extends Controller
{
    public function index(Request $request)
    {
        // 1. AMBIL DATA KOMPOS DARI DATABASE
        // Kita ambil collection agar bisa diolah dengan mudah
        $komposData = DB::table('kompos_lokasi')->get();

        // 2. HITUNG TOTAL (Untuk Footer Tabel & Scorecard)
        $totalMasuk25 = $komposData->sum('bahan_masuk_2025');
        $totalHasil25 = $komposData->sum('hasil_produksi_2025');

        $komposTotal = [
            'masuk_25'   => $totalMasuk25,
            'selain_25'  => $komposData->sum('diolah_selain_kompos_2025'),
            'kompos_25'  => $komposData->sum('diolah_untuk_kompos_2025'),
            'hasil_25'   => $totalHasil25,
            // Data 2024
            'masuk_24'   => $komposData->sum('bahan_masuk_2024'),
            'selain_24'  => $komposData->sum('diolah_selain_kompos_2024'),
            'kompos_24'  => $komposData->sum('diolah_untuk_kompos_2024'),
            'hasil_24'   => $komposData->sum('hasil_produksi_2024'),
        ];

        // 3. SIAPKAN DATA UNTUK GRAFIK (CHART)
        
        // A. Grafik Top 5 Lokasi (Berdasarkan Bahan Masuk 2025 Tertinggi)
        $top5Lokasi = $komposData->sortByDesc('bahan_masuk_2025')->take(5);
        $chartTop5 = [
            'labels' => $top5Lokasi->pluck('lokasi')->toArray(),
            'data' => $top5Lokasi->pluck('bahan_masuk_2025')->toArray(),
        ];

        // B. Hitung Efisiensi (Output dibagi Input dikali 100)
        // Menghindari pembagian dengan nol
        $efisiensi = ($totalMasuk25 > 0) ? ($totalHasil25 / $totalMasuk25) * 100 : 0;


        // 4. KIRIM SEMUA KE VIEW
        return view('pages.data-statistik', compact(
            'komposData', 
            'komposTotal',
            'chartTop5',
            'efisiensi'
        ));
    }
}