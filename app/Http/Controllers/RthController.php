<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RthController extends Controller
{
    public function index()
    {
        // =================================================================
        // BAGIAN 1: DATA IHBI (TIPOLOGI)
        // =================================================================
        $rthA = DB::table('luasan_rth_dprkpps')->where('tipologi', 'A')->orderBy('luas', 'desc')->get();
        $rthB = DB::table('luasan_rth_dprkpps')->where('tipologi', 'B')->get();
        $rthC = DB::table('luasan_rth_dprkpps')->where('tipologi', 'C')->get();
        $persentase = DB::table('persentase_tipologis')->pluck('persentase', 'tipologi');
        $ringkasan = DB::table('ringkasan_rth_kotas')->get();

        $chartPieIHBI = [
            'series' => [$rthA->sum('luas'), $rthB->sum('luas'), $rthC->sum('luas')],
            'labels' => ['Tipologi A (Publik)', 'Tipologi B (Privat)', 'Tipologi C (Badan Air)']
        ];

        // =================================================================
        // BAGIAN 2: DATA TAMAN
        // =================================================================
        $dataTaman = DB::table('rekapitulasi_rth_tamans')->orderBy('wilayah', 'asc')->get();
        $totalTaman = [
            'jml_pasif' => $dataTaman->sum('jumlah_taman_pasif_jalur_hijau'),
            'luas_pasif' => $dataTaman->sum('luas_taman_pasif_jalur_hijau'),
            'jml_aktif' => $dataTaman->sum('jumlah_taman_aktif'),
            'luas_aktif' => $dataTaman->sum('luas_taman_aktif'),
            'jml_kota' => $dataTaman->sum('jumlah_taman_kota'),
            'luas_kota' => $dataTaman->sum('luas_taman_kota'),
            'luas_total' => $dataTaman->sum('luas_per_wilayah'),
        ];
        $chartBarTaman = [
            'labels' => $dataTaman->pluck('wilayah')->toArray(),
            'data' => $dataTaman->pluck('luas_per_wilayah')->toArray()
        ];

        // =================================================================
        // BAGIAN 3: DATA MAKAM
        // =================================================================
        $dataMakamLuas = DB::table('rekapitulasi_rth_makams')->get();
        $totalLuasMakam = $dataMakamLuas->sum('luas');
        $dataKapasitas = DB::table('kapasitas_makams')->get();
        $totalSisaPetak = $dataKapasitas->sum('sisa_petak');
        $totalMakamTerisi = $dataKapasitas->sum('jumlah_data_kematian');

        // =================================================================
        // BAGIAN 4: DATA KREMATORIUM
        // =================================================================
        $krematoriumKompor = DB::table('kompor_krematoriums')->get();
        $krematoriumPegawai = DB::table('pegawai_krematoriums')->get();
        $krematoriumJabatan = DB::table('catatan_jabatan_krematoriums')->get();
        $totalPegawaiKrematorium = $krematoriumPegawai->count();
        $komporRusak = $krematoriumKompor->where('kondisi', 'Rusak')->sum('jumlah');
        $komporBaik = $krematoriumKompor->where('kondisi', 'Bisa Digunakan')->sum('jumlah');

        // =================================================================
        // BAGIAN 5: DATA SARPRAS (BBM) & CSR (BARU)
        // =================================================================
        $bbmKendaraan = DB::table('kebutuhan_bbm_kendaraan_operasionals')->get();
        $bbmPeralatan = DB::table('kebutuhan_bbm_peralatan_operasionals')->get();
        $dataCSR = DB::table('rth_skema_csrs')->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();

        // Hitung Total Kebutuhan BBM (Setahun)
        $totalBBM = [
            'kendaraan_pertamax' => $bbmKendaraan->sum('kebutuhan_1_tahun_pertamax'),
            'kendaraan_dexlite' => $bbmKendaraan->sum('kebutuhan_1_tahun_dexlite'),
            'peralatan_pertamax' => $bbmPeralatan->sum('kebutuhan_1_tahun_pertamax'),
            'unit_kendaraan' => $bbmKendaraan->sum('jumlah_total'),
            'unit_peralatan' => $bbmPeralatan->sum('jumlah_total'),
        ];

        return view('pages.rth-surabaya', compact(
            // IHBI
            'rthA', 'rthB', 'rthC', 'persentase', 'ringkasan', 'chartPieIHBI',
            // Taman
            'dataTaman', 'totalTaman', 'chartBarTaman',
            // Makam
            'dataMakamLuas', 'totalLuasMakam', 'dataKapasitas', 'totalSisaPetak', 'totalMakamTerisi',
            // Krematorium
            'krematoriumKompor', 'krematoriumPegawai', 'krematoriumJabatan', 'totalPegawaiKrematorium', 'komporRusak', 'komporBaik',
            // Sarpras & CSR
            'bbmKendaraan', 'bbmPeralatan', 'dataCSR', 'totalBBM'
        ));
    }
}