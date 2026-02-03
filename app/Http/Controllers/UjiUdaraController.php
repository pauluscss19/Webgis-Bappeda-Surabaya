<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjiUdaraController extends Controller
{
    public function index()
    {
        // 1. AMBIL DATA UTAMA
        $ambien = DB::table('uji_udara_ambien_particulate_counters')->get();
        $passive = DB::table('uji_udara_passive_samplers')->get();
        $sumur = DB::table('sumur_pantaus')->get();
        $spkua = DB::table('spkuas')->get();

        // 2. SIAPKAN DATA UNTUK GRAFIK (Pie Chart)
        // Menghitung jumlah titik berdasarkan kategori kawasan (Pemukiman, Industri, dll)
        $chartData = $ambien->groupBy('peruntukan_kawasan')->map(function ($row) {
            return $row->count();
        });

        // Pisahkan Label dan Data untuk dikirim ke ApexCharts
        $chartCategories = $chartData->keys()->toArray();
        $chartSeries = $chartData->values()->toArray();

        // 3. HITUNG TOTAL (Scorecards)
        $totalAmbien = $ambien->count();
        $totalPassive = $passive->count();
        $totalAlat = $sumur->count() + $spkua->count();

        return view('pages.uji-udara', compact(
            'ambien', 'passive', 'sumur', 'spkua',
            'chartCategories', 'chartSeries',
            'totalAmbien', 'totalPassive', 'totalAlat'
        ));
    }
}