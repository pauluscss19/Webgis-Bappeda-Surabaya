<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataStatistikController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Tab dari URL, default ke 'sarpras'
        $tab = $request->query('tab', 'sarpras');

        // Variabel untuk menyimpan data list detail (Pagination)
        $listData = null;

        // ==========================================
        // A. DATA SARPRAS (Global)
        // ==========================================
        $summary = [
            'fasilitas' => DB::table('master_fasilitas_rinci')->count(),
            'bank_sampah' => DB::table('master_bank_sampah')->count(),
        ];

        // Grafik Donut Fasilitas
        $rawFasilitas = DB::table('master_fasilitas_rinci')
            ->select('jenis_fasilitas', DB::raw('count(*) as total'))
            ->whereNotNull('jenis_fasilitas')
            ->groupBy('jenis_fasilitas')
            ->pluck('total', 'jenis_fasilitas')
            ->toArray();

        if (empty($rawFasilitas)) {
            $sarpras_labels = ['Data Kosong'];
            $sarpras_values = [0];
        } else {
            $sarpras_labels = array_keys($rawFasilitas);
            $sarpras_values = array_map('intval', array_values($rawFasilitas));
        }

        // --- AMBIL DATA DETAIL JIKA TAB SARPRAS (PAGINATION) ---
        if ($tab == 'sarpras') {
            $listData = DB::table('master_fasilitas_rinci')
                ->select('nama_fasilitas', 'jenis_fasilitas', 'alamat', 'kecamatan', 'kelurahan')
                ->orderBy('jenis_fasilitas', 'asc')
                ->paginate(10)
                ->appends(['tab' => 'sarpras']);
        }

        // ==========================================
        // B. DATA ARMADA & BBM (FIXED LOGIC)
        // ==========================================

        // 1. Grafik Pie Armada
        $rawArmada = DB::table('master_armada')
            ->select('jenis_kendaraan', DB::raw('SUM(jumlah_unit) as total'))
            ->groupBy('jenis_kendaraan')
            ->pluck('total', 'jenis_kendaraan')
            ->toArray();

        if (empty($rawArmada)) {
            $armada_labels = ['Belum Ada Data'];
            $armada_values = [0];
        } else {
            $armada_labels = array_keys($rawArmada);
            $armada_values = array_map('intval', array_values($rawArmada));
        }

        // 2. Grafik BBM Multi-Series & Costs
        $bbmData = DB::table('laporan_bbm')->orderBy('bulan_ke', 'asc')->get();

        if ($bbmData->isEmpty()) {
            // Default Data Dummy jika tabel kosong (biar tidak error)
            $bbm_labels = ['Jan', 'Feb', 'Mar'];
            $bbm_series = [
                ['name' => 'Solar', 'data' => [0, 0, 0]],
                ['name' => 'Dexlite', 'data' => [0, 0, 0]],
                ['name' => 'Pertamax', 'data' => [0, 0, 0]]
            ];
            // FIX: Siapkan struktur costs dummy juga
            $bbm_costs = [
                ['total_liter' => 0, 'total_biaya' => 0],
                ['total_liter' => 0, 'total_biaya' => 0],
                ['total_liter' => 0, 'total_biaya' => 0]
            ];
        } else {
            $bbm_labels = $bbmData->pluck('nama_bulan')->toArray();
            $bbm_series = [
                ['name' => 'Solar', 'data' => $bbmData->pluck('solar_liter')->map(fn($v) => (float)$v)->toArray()],
                ['name' => 'Dexlite', 'data' => $bbmData->pluck('dexlite_liter')->map(fn($v) => (float)$v)->toArray()],
                ['name' => 'Pertamax', 'data' => $bbmData->pluck('pertamax_liter')->map(fn($v) => (float)$v)->toArray()]
            ];

            // FIX: Hitung Costs (Biaya) Real
            $bbm_costs = $bbmData->map(function ($row) {
                return [
                    'total_liter' => $row->solar_liter + $row->dexlite_liter + $row->pertamax_liter,
                    'total_biaya' => $row->biaya_solar + $row->biaya_dexlite + $row->biaya_pertamax
                ];
            })->toArray();
        }

        // ==========================================
        // C. DATA TPA (Tren Tahunan)
        // ==========================================
        $rawTPA = DB::table('laporan_tpa_rekap')->orderBy('tahun', 'asc')->get();

        if ($rawTPA->isEmpty()) {
            $tpa_labels = ['2023', '2024', '2025'];
            $tpa_values = [0, 0, 0];
            $tpa_biaya = [0, 0, 0];
        } else {
            $tpa_labels = $rawTPA->pluck('tahun')->toArray();
            $tpa_values = $rawTPA->pluck('total_tonase')->map(fn($v) => (float)$v)->toArray();
            $tpa_biaya = $rawTPA->pluck('biaya_tipping_fee')->map(fn($v) => (float)$v)->toArray();
        }

        // ==========================================
        // D. DATA TPS3R (Top 10)
        // ==========================================
        $tps3rData = DB::table('laporan_tps3r_harian')
            ->select(
                'lokasi',
                DB::raw('SUM(sampah_masuk_ton_hari) as total_masuk'),
                DB::raw('SUM(residu_ton_hari) as total_residu')
            )
            ->groupBy('lokasi')
            ->orderByDesc('total_masuk')
            ->limit(10)
            ->get();

        $chart_tps3r = [
            'label' => $tps3rData->pluck('lokasi')->toArray(),
            'masuk' => $tps3rData->pluck('total_masuk')->map(fn($v) => (float)$v)->toArray(),
            'residu' => $tps3rData->pluck('total_residu')->map(fn($v) => (float)$v)->toArray()
        ];

        // ==========================================
        // E. DATA LIMBAH B3
        // ==========================================
        $b3Data = DB::table('laporan_b3_rt')
            ->select('jenis_limbah', DB::raw('SUM(berat_kg) as total'))
            ->groupBy('jenis_limbah')
            ->get();

        $chart_b3 = [
            'label' => $b3Data->pluck('jenis_limbah')->toArray(),
            'value' => $b3Data->pluck('total')->map(fn($v) => (float)$v)->toArray()
        ];

        // ==========================================
        // FINAL PACKING
        // ==========================================
        $data = [
            'summary' => $summary,
            'chart_sarpras' => ['label' => $sarpras_labels, 'value' => $sarpras_values],
            'chart_armada' => ['label' => $armada_labels, 'value' => $armada_values],

            // BAGIAN PENTING: Pastikan key 'costs' ada di sini!
            'chart_bbm' => [
                'label' => $bbm_labels,
                'series' => $bbm_series,
                'costs' => $bbm_costs // <--- INI SOLUSINYA
            ],

            'trend_tpa' => ['label' => $tpa_labels, 'value' => $tpa_values, 'biaya' => $tpa_biaya],
            'chart_tps3r' => $chart_tps3r,
            'chart_b3' => $chart_b3
        ];

        return view('pages.data-statistik', compact('tab', 'data', 'listData'));
    }
}
