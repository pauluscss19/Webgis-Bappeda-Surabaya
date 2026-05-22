<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UjiUdaraSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('uji_udara_ambien_particulate_counters')->truncate();
        DB::table('uji_udara_passive_samplers')->truncate();
        DB::table('sumur_pantaus')->truncate();
        DB::table('spkuas')->truncate();

        // ============================================================
        // 1. TABLE: UJI UDARA AMBIEN PARTICULATE COUNTER (60 TITIK)
        // ============================================================
        $ambien = [
            ['lokasi' => 'Kantor Kecamatan Tenggilis Mejoyo', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Bulak Banteng', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Rungkut Menanggal', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kecamatan Gayungan', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kecamatan Rungkut', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kelurahan Embong Kaliasin', 'peruntukan_kawasan' => 'Perkantoran'],
            ['lokasi' => 'Kantor Kelurahan Panjang Jiwo', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Wonokromo', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Jagir', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Penjaringan Sari', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Pucang Sewu', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kelurahan Baratajaya', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kecamatan Gubeng', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Dinas Lingkungan Hidup SBY', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kecamatan Tandes', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kecamatan Jambangan', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kecamatan Mulyorejo', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kecamatan Genteng', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Kecamatan Benowo', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kecamatan Semampir', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kelurahan Kebonsari', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kecamatan Dukuh Pakis', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kecamatan Tambaksari', 'peruntukan_kawasan' => 'Perkantoran'],
            ['lokasi' => 'Kebun Raya Mangrove Gunung Anyar', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kebun Raya Mangrove Wonorejo', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kantor Pusdiklat Kebakaran Kota Sby', 'peruntukan_kawasan' => 'Industri'],
            ['lokasi' => 'Kantor PMK Rungkut Industri', 'peruntukan_kawasan' => 'Industri'],
            ['lokasi' => 'Terminal Intermoda Joyoboyo', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'PT. Sucofindo A. Yani', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Taman Sejarah', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kelurahan Putat Gede', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Kantor Kelurahan Babatan', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Hotel Grand Sumatera', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Hotel Kita Jl. Karangmenjangan', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'Hotel Semut Jl. Samudra No. 9-15', 'peruntukan_kawasan' => 'Transportasi'],
            ['lokasi' => 'SMP Negeri 26 Surabaya', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'SMP Luqman Al - Hakim', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'SMP Negeri 19 Surabaya', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'SMP Negeri 12 Surabaya', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'SMA Negeri 4 Surabaya', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'SMA Negeri 6 Surabaya', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'SMP Negeri 5 Surabaya', 'peruntukan_kawasan' => 'Fasilitas Pendidikan'],
            ['lokasi' => 'RS Royal', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RSIA Lombok Dua-dua', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RSUD BDH', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RS Mitra Keluarga Satelit', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RSIA Idaf Husada', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RSUD dr. Mohamad Soewandhie', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RS Mitra Keluarga Kenjeran', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'RSI Jemursari Surabaya', 'peruntukan_kawasan' => 'Sekitar Rumah Sakit'],
            ['lokasi' => 'Kebun Raya Mangrove Gunung Anyar', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Kebun Raya Mangrove Wonorejo', 'peruntukan_kawasan' => 'Pemukiman'],
            ['lokasi' => 'Gudang DLH Tanjungsari', 'peruntukan_kawasan' => 'Industri'],
            ['lokasi' => 'IPAL PT. SIER Rungkut Industri', 'peruntukan_kawasan' => 'Industri'],
            ['lokasi' => 'Pakuwon City Mall', 'peruntukan_kawasan' => 'Mall / Pusat Perbelanjaan'],
            ['lokasi' => 'TP', 'peruntukan_kawasan' => 'Mall / Pusat Perbelanjaan'],
            ['lokasi' => 'PTC', 'peruntukan_kawasan' => 'Mall / Pusat Perbelanjaan'],
            ['lokasi' => 'WTC eMall', 'peruntukan_kawasan' => 'Mall / Pusat Perbelanjaan'],
            ['lokasi' => 'PT. Bayu Beringin Lestari (Surabaya Plaza)', 'peruntukan_kawasan' => 'Mall / Pusat Perbelanjaan'],
            ['lokasi' => 'KBS', 'peruntukan_kawasan' => 'Transportasi'],
        ];
        DB::table('uji_udara_ambien_particulate_counters')->insert($ambien);

        // ============================================================
        // 2. TABLE: UJI UDARA PASSIVE SAMPLER (4 TITIK)
        // ============================================================
        $passive = [
            ['lokasi' => 'Jl. Margomulyo, Komplek Pergudangan Sari Mulia', 'kawasan' => 'Industri', 'keterangan' => 'Dilaksanakan 2x dalam setahun. Data yang diperoleh 8 data'],
            ['lokasi' => 'Perumahan Citraland Surabaya', 'kawasan' => 'Permukiman', 'keterangan' => null],
            ['lokasi' => 'Jl. Merr', 'kawasan' => 'Transportasi', 'keterangan' => null],
            ['lokasi' => 'Taman Bungkul', 'kawasan' => 'Perkantoran', 'keterangan' => null],
        ];
        DB::table('uji_udara_passive_samplers')->insert($passive);

        // ============================================================
        // 3. TABLE: SUMUR PANTAU (2 TITIK)
        // ============================================================
        $sumur = [
            ['nama_sumur' => 'Sumur Pantau Tandes', 'keterangan' => '1 data/hari, total setahun 365 data'],
            ['nama_sumur' => 'Sumur Pantau Gayungan', 'keterangan' => '1 data/hari, total setahun 365 data'],
        ];
        DB::table('sumur_pantaus')->insert($sumur);

        // ============================================================
        // 4. TABLE: SPKUA (2 TITIK)
        // ============================================================
        $spkua = [
            ['nama_spkua' => 'SPKUA Wonorejo', 'keterangan' => '1 data/hari, total setahun 365 data'],
            ['nama_spkua' => 'SPKUA Kebonsari', 'keterangan' => '1 data/hari, total setahun 365 data'],
        ];
        DB::table('spkuas')->insert($spkua);
    }
}