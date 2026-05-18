<?php

namespace App\Http\Controllers;

use App\Models\DataSampah;
use App\Models\DataKualitasLingkungan;
use App\Models\SarprasPeralatan;
use App\Models\RthData;
use Illuminate\Http\Request;

class RingkasanController extends Controller
{
    public function index()
    {
        // Tab 1: Data Sampah
        $sampah = [
            'total_data'       => DataSampah::count(),
            'total_volume'     => DataSampah::sum('volume_sampah_ton'),
            'total_terangkut'  => DataSampah::sum('sampah_terangkut_ton'),
            'total_diolah'     => DataSampah::sum('sampah_diolah_ton'),
            'total_tidak_terkelola' => DataSampah::sum('sampah_tidak_terkelola_ton'),
            'total_tps'        => DataSampah::sum('jumlah_tps'),
            'total_bank_sampah' => DataSampah::sum('jumlah_bank_sampah'),
            'chart_labels'     => DataSampah::orderBy('volume_sampah_ton', 'desc')->limit(8)->pluck('kecamatan')->toArray(),
            'chart_values'     => DataSampah::orderBy('volume_sampah_ton', 'desc')->limit(8)->pluck('volume_sampah_ton')->toArray(),
        ];

        // Tab 2: Kualitas Lingkungan
        $kualitas = [
            'total_data'       => DataKualitasLingkungan::count(),
            'memenuhi'         => DataKualitasLingkungan::where('status', 'memenuhi')->count(),
            'tidak_memenuhi'   => DataKualitasLingkungan::where('status', 'tidak_memenuhi')->count(),
            'belum_diuji'      => DataKualitasLingkungan::where('status', 'belum_diuji')->count(),
            'by_jenis' => [
                'air_sungai'    => DataKualitasLingkungan::where('jenis_uji', 'air_sungai')->count(),
                'air_laut'      => DataKualitasLingkungan::where('jenis_uji', 'air_laut')->count(),
                'udara_ambien'  => DataKualitasLingkungan::where('jenis_uji', 'udara_ambien')->count(),
                'tanah'         => DataKualitasLingkungan::where('jenis_uji', 'tanah')->count(),
                'kebisingan'    => DataKualitasLingkungan::where('jenis_uji', 'kebisingan')->count(),
            ],
        ];

        // Tab 3: Sarpras
        $sarprasAll = SarprasPeralatan::all();
        $sarpras = [
            'total_data'       => $sarprasAll->count(),
            'total_unit'       => $sarprasAll->sum('jumlah_total'),
            'total_beroperasi' => $sarprasAll->sum('jumlah_beroperasi'),
            'total_rusak'      => $sarprasAll->sum('jumlah_rusak'),
            'chart_labels'     => $sarprasAll->pluck('tipe_peralatan')->toArray(),
            'chart_values'     => $sarprasAll->pluck('jumlah_total')->map(fn($v) => (int) $v)->toArray(),
        ];

        // Tab 4: RTH
        $rthAll = RthData::all();
        $rth = [
            'total_data'  => $rthAll->count(),
            'total_luas'  => $rthAll->sum('luas'),
            'luas_a'      => $rthAll->where('tipologi', 'A')->sum('luas'),
            'luas_b'      => $rthAll->where('tipologi', 'B')->sum('luas'),
            'luas_c'      => $rthAll->where('tipologi', 'C')->sum('luas'),
        ];

        return view('pages.crud.ringkasan', compact('sampah', 'kualitas', 'sarpras', 'rth'));
    }
}
