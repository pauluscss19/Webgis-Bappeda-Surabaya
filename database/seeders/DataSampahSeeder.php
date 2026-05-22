<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSampahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('data_sampah')->truncate();
        
        $kecamatanData = [
            ['kecamatan' => 'Sukolilo', 'kelurahan' => 'Keputih', 'volume' => 45.8, 'terangkut' => 32.5, 'diolah' => 8.2, 'tidak' => 5.1, 'tps' => 12, 'bank' => 5],
            ['kecamatan' => 'Rungkut', 'kelurahan' => 'Kalirungkut', 'volume' => 52.3, 'terangkut' => 38.1, 'diolah' => 10.5, 'tidak' => 3.7, 'tps' => 15, 'bank' => 8],
            ['kecamatan' => 'Wonokromo', 'kelurahan' => 'Jagir', 'volume' => 38.6, 'terangkut' => 28.9, 'diolah' => 6.4, 'tidak' => 3.3, 'tps' => 10, 'bank' => 4],
            ['kecamatan' => 'Gubeng', 'kelurahan' => 'Airlangga', 'volume' => 41.2, 'terangkut' => 30.1, 'diolah' => 7.8, 'tidak' => 3.3, 'tps' => 11, 'bank' => 6],
            ['kecamatan' => 'Tegalsari', 'kelurahan' => 'Tegalsari', 'volume' => 33.9, 'terangkut' => 24.5, 'diolah' => 5.9, 'tidak' => 3.5, 'tps' => 8, 'bank' => 3],
            ['kecamatan' => 'Genteng', 'kelurahan' => 'Genteng', 'volume' => 29.5, 'terangkut' => 22.3, 'diolah' => 4.8, 'tidak' => 2.4, 'tps' => 7, 'bank' => 4],
            ['kecamatan' => 'Sawahan', 'kelurahan' => 'Petemon', 'volume' => 48.7, 'terangkut' => 35.6, 'diolah' => 9.1, 'tidak' => 4.0, 'tps' => 14, 'bank' => 7],
            ['kecamatan' => 'Tambaksari', 'kelurahan' => 'Ploso', 'volume' => 55.1, 'terangkut' => 40.2, 'diolah' => 11.3, 'tidak' => 3.6, 'tps' => 16, 'bank' => 9],
            ['kecamatan' => 'Kenjeran', 'kelurahan' => 'Bulak Banteng', 'volume' => 36.4, 'terangkut' => 26.8, 'diolah' => 6.1, 'tidak' => 3.5, 'tps' => 9, 'bank' => 3],
            ['kecamatan' => 'Semampir', 'kelurahan' => 'Ampel', 'volume' => 42.8, 'terangkut' => 31.5, 'diolah' => 7.5, 'tidak' => 3.8, 'tps' => 12, 'bank' => 5],
            ['kecamatan' => 'Krembangan', 'kelurahan' => 'Perak Barat', 'volume' => 31.7, 'terangkut' => 23.4, 'diolah' => 5.3, 'tidak' => 3.0, 'tps' => 8, 'bank' => 4],
            ['kecamatan' => 'Pabean Cantian', 'kelurahan' => 'Bongkaran', 'volume' => 28.3, 'terangkut' => 21.2, 'diolah' => 4.6, 'tidak' => 2.5, 'tps' => 7, 'bank' => 3],
            ['kecamatan' => 'Bubutan', 'kelurahan' => 'Bubutan', 'volume' => 35.1, 'terangkut' => 25.9, 'diolah' => 6.0, 'tidak' => 3.2, 'tps' => 9, 'bank' => 4],
            ['kecamatan' => 'Tandes', 'kelurahan' => 'Tandes', 'volume' => 39.8, 'terangkut' => 29.3, 'diolah' => 7.2, 'tidak' => 3.3, 'tps' => 11, 'bank' => 5],
            ['kecamatan' => 'Sukomanunggal', 'kelurahan' => 'Simomulyo', 'volume' => 44.5, 'terangkut' => 33.1, 'diolah' => 8.0, 'tidak' => 3.4, 'tps' => 13, 'bank' => 6],
        ];

        foreach ($kecamatanData as $d) {
            DB::table('data_sampah')->insert([
                'kecamatan' => $d['kecamatan'],
                'kelurahan' => $d['kelurahan'],
                'volume_sampah_ton' => $d['volume'],
                'sampah_terangkut_ton' => $d['terangkut'],
                'sampah_diolah_ton' => $d['diolah'],
                'sampah_tidak_terkelola_ton' => $d['tidak'],
                'jumlah_tps' => $d['tps'],
                'jumlah_bank_sampah' => $d['bank'],
                'sumber_data' => 'DKRTH Surabaya',
                'tahun' => 2025,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
