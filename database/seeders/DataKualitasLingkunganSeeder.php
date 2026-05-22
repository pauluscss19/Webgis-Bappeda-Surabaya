<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataKualitasLingkunganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('data_kualitas_lingkungan')->truncate();

        $data = [
            ['lokasi' => 'Sungai Kalimas', 'kecamatan' => 'Genteng', 'jenis_uji' => 'air_sungai', 'parameter' => 'BOD', 'nilai' => 4.2, 'satuan' => 'mg/L', 'baku' => 6.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Sungai Kalimas', 'kecamatan' => 'Genteng', 'jenis_uji' => 'air_sungai', 'parameter' => 'COD', 'nilai' => 22.5, 'satuan' => 'mg/L', 'baku' => 50.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Sungai Jagir', 'kecamatan' => 'Wonokromo', 'jenis_uji' => 'air_sungai', 'parameter' => 'BOD', 'nilai' => 8.5, 'satuan' => 'mg/L', 'baku' => 6.0, 'status' => 'tidak_memenuhi'],
            ['lokasi' => 'Sungai Jagir', 'kecamatan' => 'Wonokromo', 'jenis_uji' => 'air_sungai', 'parameter' => 'pH', 'nilai' => 7.2, 'satuan' => '-', 'baku' => 9.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Pantai Kenjeran', 'kecamatan' => 'Kenjeran', 'jenis_uji' => 'air_laut', 'parameter' => 'TSS', 'nilai' => 85.3, 'satuan' => 'mg/L', 'baku' => 80.0, 'status' => 'tidak_memenuhi'],
            ['lokasi' => 'Pelabuhan Tanjung Perak', 'kecamatan' => 'Pabean Cantian', 'jenis_uji' => 'air_laut', 'parameter' => 'DO', 'nilai' => 5.8, 'satuan' => 'mg/L', 'baku' => 5.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Kawasan Industri Rungkut', 'kecamatan' => 'Rungkut', 'jenis_uji' => 'udara_ambien', 'parameter' => 'PM10', 'nilai' => 68.4, 'satuan' => 'µg/m³', 'baku' => 150.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Kawasan Industri Rungkut', 'kecamatan' => 'Rungkut', 'jenis_uji' => 'udara_ambien', 'parameter' => 'SO2', 'nilai' => 42.1, 'satuan' => 'µg/m³', 'baku' => 365.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Pusat Kota Tunjungan', 'kecamatan' => 'Genteng', 'jenis_uji' => 'udara_ambien', 'parameter' => 'NO2', 'nilai' => 55.8, 'satuan' => 'µg/m³', 'baku' => 150.0, 'status' => 'memenuhi'],
            ['lokasi' => 'TPA Benowo', 'kecamatan' => 'Benowo', 'jenis_uji' => 'tanah', 'parameter' => 'Pb (Timbal)', 'nilai' => 120.5, 'satuan' => 'mg/kg', 'baku' => 100.0, 'status' => 'tidak_memenuhi'],
            ['lokasi' => 'Kawasan Suramadu', 'kecamatan' => 'Kenjeran', 'jenis_uji' => 'kebisingan', 'parameter' => 'Leq', 'nilai' => 72.3, 'satuan' => 'dB(A)', 'baku' => 70.0, 'status' => 'tidak_memenuhi'],
            ['lokasi' => 'Sungai Wonokromo', 'kecamatan' => 'Wonokromo', 'jenis_uji' => 'air_sungai', 'parameter' => 'Fosfat', 'nilai' => null, 'satuan' => 'mg/L', 'baku' => 1.0, 'status' => 'belum_diuji'],
            ['lokasi' => 'Taman Bungkul', 'kecamatan' => 'Wonokromo', 'jenis_uji' => 'kebisingan', 'parameter' => 'Leq', 'nilai' => 58.2, 'satuan' => 'dB(A)', 'baku' => 70.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Kawasan Gubeng', 'kecamatan' => 'Gubeng', 'jenis_uji' => 'udara_ambien', 'parameter' => 'CO', 'nilai' => 8.2, 'satuan' => 'µg/m³', 'baku' => 30000.0, 'status' => 'memenuhi'],
            ['lokasi' => 'Sungai Brantas Hilir', 'kecamatan' => 'Sawahan', 'jenis_uji' => 'air_sungai', 'parameter' => 'TSS', 'nilai' => null, 'satuan' => 'mg/L', 'baku' => 50.0, 'status' => 'belum_diuji'],
        ];

        foreach ($data as $d) {
            DB::table('data_kualitas_lingkungan')->insert([
                'lokasi' => $d['lokasi'],
                'kecamatan' => $d['kecamatan'],
                'kelurahan' => null,
                'jenis_uji' => $d['jenis_uji'],
                'parameter_uji' => $d['parameter'],
                'nilai_hasil' => $d['nilai'],
                'satuan' => $d['satuan'],
                'baku_mutu' => $d['baku'],
                'status' => $d['status'],
                'tanggal_uji' => $d['status'] !== 'belum_diuji' ? '2025-03-' . rand(1, 28) : null,
                'tahun' => 2025,
                'sumber_data' => 'DLH Surabaya',
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
