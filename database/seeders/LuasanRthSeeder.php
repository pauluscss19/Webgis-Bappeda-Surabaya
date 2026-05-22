<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LuasanRthSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('luasan_rth_dprkpps')->truncate();
        DB::table('persentase_tipologis')->truncate();
        DB::table('ringkasan_rth_kotas')->truncate();

        // 1. Data Detail RTH
        $rthData = [
            // TIPOLOGI A
            ['tipologi' => 'A', 'zona' => 'Rimba Kota', 'kode' => 'RTH-1', 'luas' => 1578, 'bobot' => 100, 'luas_x_bobot' => 1578, 'fhbi' => 3, 'jumlah' => 4734],
            ['tipologi' => 'A', 'zona' => 'Taman (Jumlah Semua Taman)', 'kode' => null, 'luas' => 484, 'bobot' => null, 'luas_x_bobot' => null, 'fhbi' => null, 'jumlah' => null],
            ['tipologi' => 'A', 'zona' => 'Taman Kota', 'kode' => 'RTH-2', 'luas' => 406, 'bobot' => 100, 'luas_x_bobot' => 406, 'fhbi' => 2.5, 'jumlah' => 1015],
            ['tipologi' => 'A', 'zona' => 'Taman Kecamatan', 'kode' => 'RTH-3', 'luas' => 13, 'bobot' => 100, 'luas_x_bobot' => 13, 'fhbi' => 2, 'jumlah' => 26],
            ['tipologi' => 'A', 'zona' => 'Taman Kelurahan', 'kode' => 'RTH-4', 'luas' => 42, 'bobot' => 100, 'luas_x_bobot' => 42, 'fhbi' => 1.8, 'jumlah' => 76],
            ['tipologi' => 'A', 'zona' => 'Taman RW', 'kode' => 'RTH-5', 'luas' => 22, 'bobot' => 100, 'luas_x_bobot' => 22, 'fhbi' => 1.6, 'jumlah' => 35],
            ['tipologi' => 'A', 'zona' => 'Taman RT', 'kode' => 'RTH-6', 'luas' => 1, 'bobot' => 100, 'luas_x_bobot' => 1, 'fhbi' => 1.5, 'jumlah' => 2],
            ['tipologi' => 'A', 'zona' => 'Pemakaman', 'kode' => 'RTH-7', 'luas' => 388, 'bobot' => 100, 'luas_x_bobot' => 388, 'fhbi' => 1.3, 'jumlah' => 504],
            ['tipologi' => 'A', 'zona' => 'Jalur Hijau', 'kode' => 'RTH-8', 'luas' => 119, 'bobot' => 100, 'luas_x_bobot' => 119, 'fhbi' => 1.5, 'jumlah' => 179],

            // TIPOLOGI B
            ['tipologi' => 'B', 'zona' => 'Perlindungan Setempat', 'kode' => 'PS', 'luas' => 225, 'bobot' => 50, 'luas_x_bobot' => 113, 'fhbi' => 1, 'jumlah' => 113],
            ['tipologi' => 'B', 'zona' => 'Ekosistem Mangrove', 'kode' => 'EN', 'luas' => 306, 'bobot' => 20, 'luas_x_bobot' => 61, 'fhbi' => 1, 'jumlah' => 61],

            // TIPOLOGI C
            ['tipologi' => 'C', 'zona' => 'Sungai (Badan Air)', 'kode' => 'BA', 'luas' => 543, 'bobot' => 20, 'luas_x_bobot' => 108.6, 'fhbi' => 1, 'jumlah' => 109],
        ];
        DB::table('luasan_rth_dprkpps')->insert($rthData);

        // 2. Data Persentase
        $persentase = [
            ['tipologi' => 'A', 'persentase' => 19.00],
            ['tipologi' => 'B', 'persentase' => 1.00],
            ['tipologi' => 'C', 'persentase' => 0.32],
        ];
        DB::table('persentase_tipologis')->insert($persentase);

        // 3. Data Ringkasan
        $ringkasan = [
            ['keterangan' => 'Luas RTH Kota Surabaya', 'nilai' => 6853],
            ['keterangan' => 'Luas Kota Surabaya', 'nilai' => 33725],
            ['keterangan' => 'Persentase RTH Kota Surabaya', 'nilai' => 20.32],
        ];
        DB::table('ringkasan_rth_kotas')->insert($ringkasan);
    }
}