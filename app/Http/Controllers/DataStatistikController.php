<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataStatistikController extends Controller
{
    public function index(Request $request)
    {
        // 1. TANGKAP TAB (Default ke 'sarpras' sesuai view baru Anda)
        $tab = $request->query('tab', 'sarpras');

        // ==========================================
        // BAGIAN 1: DATA KOMPOS (Jaga-jaga jika masih dipakai di layout lain)
        // ==========================================
        $komposData = DB::table('kompos_lokasi')->get();
        $totalMasuk25 = $komposData->sum('bahan_masuk_2025');
        $totalHasil25 = $komposData->sum('hasil_produksi_2025');

        $komposTotal = [
            'masuk_25'   => $totalMasuk25,
            'hasil_25'   => $totalHasil25,
            'masuk_24'   => $komposData->sum('bahan_masuk_2024'),
            'hasil_24'   => $komposData->sum('hasil_produksi_2024'),
        ];
        
        // Data Grafik Kompos
        $top5Lokasi = $komposData->sortByDesc('bahan_masuk_2025')->take(5);
        $chartTop5 = [
            'labels' => $top5Lokasi->pluck('lokasi')->toArray(),
            'data' => $top5Lokasi->pluck('bahan_masuk_2025')->toArray(),
        ];
        $efisiensi = ($totalMasuk25 > 0) ? ($totalHasil25 / $totalMasuk25) * 100 : 0;


        // ==========================================
        // BAGIAN 2: DATA STATISTIK LINGKUNGAN (SARPRAS, DLL)
        // ==========================================
        
        $listData = null; // Default null untuk pagination

        // --- A. DATA SARPRAS (FASILITAS) ---
        // Menggunakan tabel 'kebutuhan_bbm_peralatan_operasionals' (seed: FasilitasPeralatanSeeder)
        $fasilitas = DB::table('kebutuhan_bbm_peralatan_operasionals')->orderBy('jumlah_total', 'desc')->get();
        
        $chartSarpras = [
            'label' => $fasilitas->pluck('tipe_peralatan')->toArray(),
            'value' => $fasilitas->pluck('jumlah_total')->map(fn ($v) => (int) $v)->values()->toArray()
        ];
        if (empty($chartSarpras['label'])) {
            $chartSarpras = ['label' => [], 'value' => []];
        }

        $summary = [
            'fasilitas' => (int) $fasilitas->sum('jumlah_total'),
            'bank_sampah' => 0
        ];

        $listData = null;
        if ($tab == 'sarpras') {
            $listData = DB::table('kebutuhan_bbm_peralatan_operasionals')
                ->select(
                    'tipe_peralatan as nama_fasilitas',
                    'jenis_bbm as jenis_fasilitas',
                    DB::raw("CONCAT(jumlah_beroperasi, ' Unit Beroperasi') as alamat"),
                    DB::raw("'Surabaya' as kecamatan"),
                    DB::raw("'-' as kelurahan")
                )
                ->orderBy('jumlah_beroperasi', 'desc')
                ->paginate(10)
                ->appends(['tab' => 'sarpras']);
        }

        // --- B. DATA ARMADA ---
        $armada = DB::table('kebutuhan_bbm_kendaraan_operasionals')->get();
        $chartArmada = [
            'label' => $armada->pluck('tipe_kendaraan')->toArray(),
            'value' => $armada->pluck('jumlah_total')->map(fn ($v) => (int) $v)->toArray()
        ];
        if (empty($chartArmada['label'])) {
            $chartArmada = ['label' => [], 'value' => []];
        }

        // --- C. DATA BBM (Simulasi Bulanan dari Data Tahunan) ---
        // View mengharapkan data bulanan & biaya. Kita hitung rata-rata dari data tahunan DB.
        $totalPertamaxTahun = $armada->sum('kebutuhan_1_tahun_pertamax') + $fasilitas->sum('kebutuhan_1_tahun_pertamax');
        $totalDexliteTahun = $armada->sum('kebutuhan_1_tahun_dexlite') + $fasilitas->sum('kebutuhan_1_tahun_dexlite');
        
        // Simulasi data 6 bulan
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        $monthlyPertamax = $totalPertamaxTahun / 12; 
        $monthlyDexlite = $totalDexliteTahun / 12; 
        
        // Harga Asumsi (Bisa disesuaikan)
        $hargaPertamax = 12950;
        $hargaDexlite = 14550;

        $pertamaxData = array_map(fn () => round($monthlyPertamax * (rand(90, 110) / 100), 2), range(1, 6));
        $dexliteData = array_map(fn () => round($monthlyDexlite * (rand(90, 110) / 100), 2), range(1, 6));
        $chartBBM = [
            'label' => $months,
            'series' => [
                ['name' => 'Pertamax', 'data' => $pertamaxData],
                ['name' => 'Dexlite', 'data' => $dexliteData]
            ],
            'costs' => []
        ];
        for ($i = 0; $i < 6; $i++) {
            $literP = $chartBBM['series'][0]['data'][$i];
            $literD = $chartBBM['series'][1]['data'][$i];
            $chartBBM['costs'][] = [
                'total_liter' => $literP + $literD,
                'total_biaya' => ($literP * $hargaPertamax) + ($literD * $hargaDexlite)
            ];
        }

        // --- D. DATA TPA (Dummy / Kosongkan jika tabel belum ada) ---
        $trendTPA = [
            'label' => ['2023', '2024', '2025'],
            'value' => [500000, 520000, 510000],
            'biaya' => [75000000000, 78000000000, 76500000000]
        ];

        // --- E. DATA TPS 3R (Dummy) ---
        $chartTPS3R = [
            'label' => ['TPS A', 'TPS B', 'TPS C'],
            'masuk' => [100, 150, 120],
            'residu' => [20, 30, 25]
        ];

        // --- F. DATA B3 (Dummy) ---
        $chartB3 = [
            'label' => ['Medis', 'Elektronik'],
            'value' => [500, 300]
        ];

        // ==========================================
        // 3. PACKING DATA KE ARRAY '$data' (Sesuai View)
        // ==========================================
        $data = [
            'summary' => $summary,
            'chart_sarpras' => $chartSarpras,
            'chart_armada' => $chartArmada,
            'chart_bbm' => $chartBBM, // Struktur ini sudah sesuai dengan view Anda (series + costs)
            'trend_tpa' => $trendTPA,
            'chart_tps3r' => $chartTPS3R,
            'chart_b3' => $chartB3
        ];

        // 4. RETURN VIEW
        return view('pages.data-statistik', compact(
            'tab', 
            'data', // Variabel utama untuk grafik statistik
            'listData', // Variabel untuk tabel pagination
            
            // Variabel Legacy (untuk Kompos jika masih ada di header/footer view)
            'komposData', 'komposTotal', 'chartTop5', 'efisiensi'
        ));
    }
}