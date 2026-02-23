<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;

class RthController extends Controller
{
    private function table(string $name): Collection
    {
        if (! Schema::hasTable($name)) {
            return collect([]);
        }
        try {
            return DB::table($name)->get();
        } catch (\Throwable $e) {
            return collect([]);
        }
    }

    private function tableOrderBy(string $name, string $column, string $dir = 'asc'): Collection
    {
        if (! Schema::hasTable($name)) {
            return collect([]);
        }
        try {
            return DB::table($name)->orderBy($column, $dir)->get();
        } catch (\Throwable $e) {
            return collect([]);
        }
    }

    public function index()
    {
        $persentase = collect(['A' => 0, 'B' => 0, 'C' => 0]);
        if (Schema::hasTable('persentase_tipologis')) {
            try {
                $persentase = DB::table('persentase_tipologis')->pluck('persentase', 'tipologi');
            } catch (\Throwable $e) {
                // keep default
            }
        }

        $luasanRth = $this->table('luasan_rth_dprkpps');
        $rthA = $luasanRth->where('tipologi', 'A')->sortByDesc('luas')->values();
        $rthB = $luasanRth->where('tipologi', 'B')->values();
        $rthC = $luasanRth->where('tipologi', 'C')->values();
        $ringkasan = $this->table('ringkasan_rth_kotas');

        $chartPieIHBI = [
            'series' => [$rthA->sum('luas'), $rthB->sum('luas'), $rthC->sum('luas')],
            'labels' => ['Tipologi A (Publik)', 'Tipologi B (Privat)', 'Tipologi C (Badan Air)']
        ];

        $dataTaman = $this->tableOrderBy('rekapitulasi_rth_tamans', 'wilayah', 'asc');
        $totalTaman = [
            'luas_total' => $dataTaman->sum('luas_per_wilayah'),
            'jml_pasif' => $dataTaman->sum('jumlah_taman_pasif_jalur_hijau'),
            'luas_pasif' => $dataTaman->sum('luas_taman_pasif_jalur_hijau'),
            'jml_aktif' => $dataTaman->sum('jumlah_taman_aktif'),
            'luas_aktif' => $dataTaman->sum('luas_taman_aktif'),
            'jml_kota' => $dataTaman->sum('jumlah_taman_kota'),
            'luas_kota' => $dataTaman->sum('luas_taman_kota'),
        ];
        $chartBarTaman = [
            'labels' => $dataTaman->pluck('wilayah')->toArray(),
            'data' => $dataTaman->pluck('luas_per_wilayah')->toArray()
        ];

        $dataMakamLuas = $this->table('rekapitulasi_rth_makams');
        $totalLuasMakam = $dataMakamLuas->sum('luas');
        $dataKapasitas = $this->table('kapasitas_makams');
        $totalSisaPetak = $dataKapasitas->sum('sisa_petak');
        $totalMakamTerisi = $dataKapasitas->sum('jumlah_data_kematian');

        $krematoriumKompor = $this->table('kompor_krematoriums');
        $krematoriumPegawai = $this->table('pegawai_krematoriums');
        $krematoriumJabatan = $this->table('catatan_jabatan_krematoriums');
        $totalPegawaiKrematorium = $krematoriumPegawai->count();
        $komporRusak = $krematoriumKompor->where('kondisi', 'Rusak')->sum('jumlah');
        $komporBaik = $krematoriumKompor->where('kondisi', 'Bisa Digunakan')->sum('jumlah');

        $bbmKendaraan = $this->table('kebutuhan_bbm_kendaraan_operasionals');
        $bbmPeralatan = $this->table('kebutuhan_bbm_peralatan_operasionals');
        $dataCSR = Schema::hasTable('rth_skema_csrs')
            ? DB::table('rth_skema_csrs')->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get()
            : collect([]);

        $totalBBM = [
            'kendaraan_pertamax' => $bbmKendaraan->sum('kebutuhan_1_tahun_pertamax'),
            'kendaraan_dexlite' => $bbmKendaraan->sum('kebutuhan_1_tahun_dexlite'),
            'peralatan_pertamax' => $bbmPeralatan->sum('kebutuhan_1_tahun_pertamax'),
            'unit_kendaraan' => $bbmKendaraan->sum('jumlah_total'),
            'unit_peralatan' => $bbmPeralatan->sum('jumlah_total'),
        ];

        $badanAir = $this->tableOrderBy('uji_air_badan_air', 'id', 'asc');
        $pelabuhan = $this->tableOrderBy('uji_air_laut_pelabuhan', 'id', 'asc');
        $wisata = $this->tableOrderBy('uji_air_laut_wisata_bahari', 'id', 'asc');
        $biota = $this->tableOrderBy('uji_air_laut_biota_laut', 'id', 'asc');

        $ambien = $this->table('uji_udara_ambien_particulate_counters');
        $passive = $this->table('uji_udara_passive_samplers');
        $sumur = $this->table('sumur_pantaus');
        $spkua = $this->table('spkuas');
        $totalAmbien = $ambien->count();
        $totalPassive = $passive->count();
        $totalAlat = $sumur->count() + $spkua->count();

        $chartDataAmbien = $ambien->groupBy('peruntukan_kawasan')->map(fn ($item) => $item->count());
        $chartAmbien = [
            'labels' => $chartDataAmbien->keys()->toArray(),
            'series' => $chartDataAmbien->values()->toArray()
        ];
        if (empty($chartAmbien['labels'])) {
            $chartAmbien = ['labels' => ['Belum ada data'], 'series' => [0]];
        }

        return view('pages.rth-surabaya', compact(
            'rthA', 'rthB', 'rthC', 'persentase', 'ringkasan', 'chartPieIHBI',
            'dataTaman', 'totalTaman', 'chartBarTaman',
            'dataMakamLuas', 'totalLuasMakam', 'dataKapasitas', 'totalSisaPetak', 'totalMakamTerisi',
            'krematoriumKompor', 'krematoriumPegawai', 'krematoriumJabatan', 'totalPegawaiKrematorium', 'komporRusak', 'komporBaik',
            'bbmKendaraan', 'bbmPeralatan', 'dataCSR', 'totalBBM',
            'badanAir', 'pelabuhan', 'wisata', 'biota',
            'ambien', 'passive', 'sumur', 'spkua', 'totalAmbien', 'totalPassive', 'totalAlat', 'chartAmbien'
        ));
    }
}
