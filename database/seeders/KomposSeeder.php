<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomposSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['lokasi' => 'MENUR', 'bahan_masuk_2025' => 4.44, 'diolah_selain_kompos_2025' => 1.30, 'diolah_untuk_kompos_2025' => 3.14, 'hasil_produksi_2025' => 0.49, 'bahan_masuk_2024' => 3.52, 'diolah_selain_kompos_2024' => 1.14, 'diolah_untuk_kompos_2024' => 2.38, 'hasil_produksi_2024' => 0.49],
            ['lokasi' => 'KEPUTRAN', 'bahan_masuk_2025' => 6.59, 'diolah_selain_kompos_2025' => 0.00, 'diolah_untuk_kompos_2025' => 6.59, 'hasil_produksi_2025' => 0.00, 'bahan_masuk_2024' => 7.07, 'diolah_selain_kompos_2024' => 0.00, 'diolah_untuk_kompos_2024' => 7.07, 'hasil_produksi_2024' => 0.00],
            ['lokasi' => 'BRATANG', 'bahan_masuk_2025' => 5.62, 'diolah_selain_kompos_2025' => 1.49, 'diolah_untuk_kompos_2025' => 4.12, 'hasil_produksi_2025' => 0.69, 'bahan_masuk_2024' => 5.16, 'diolah_selain_kompos_2024' => 1.35, 'diolah_untuk_kompos_2024' => 3.81, 'hasil_produksi_2024' => 0.58],
            ['lokasi' => 'KAYOON', 'bahan_masuk_2025' => 1.36, 'diolah_selain_kompos_2025' => 0.23, 'diolah_untuk_kompos_2025' => 1.13, 'hasil_produksi_2025' => 0.00, 'bahan_masuk_2024' => 1.02, 'diolah_selain_kompos_2024' => 0.23, 'diolah_untuk_kompos_2024' => 0.79, 'hasil_produksi_2024' => 0.00],
            ['lokasi' => 'LIPONSOS KEPUTIH', 'bahan_masuk_2025' => 0.00, 'diolah_selain_kompos_2025' => 0.00, 'diolah_untuk_kompos_2025' => 0.00, 'hasil_produksi_2025' => 0.00, 'bahan_masuk_2024' => 0.00, 'diolah_selain_kompos_2024' => 0.00, 'diolah_untuk_kompos_2024' => 0.00, 'hasil_produksi_2024' => 0.00],
            ['lokasi' => 'WONOREJO I', 'bahan_masuk_2025' => 0.04, 'diolah_selain_kompos_2025' => 0.00, 'diolah_untuk_kompos_2025' => 0.04, 'hasil_produksi_2025' => 0.00, 'bahan_masuk_2024' => 0.04, 'diolah_selain_kompos_2024' => 0.00, 'diolah_untuk_kompos_2024' => 0.04, 'hasil_produksi_2024' => 0.00],
            ['lokasi' => 'RUNGKUT ASRI', 'bahan_masuk_2025' => 4.11, 'diolah_selain_kompos_2025' => 1.33, 'diolah_untuk_kompos_2025' => 2.78, 'hasil_produksi_2025' => 0.00, 'bahan_masuk_2024' => 3.83, 'diolah_selain_kompos_2024' => 1.26, 'diolah_untuk_kompos_2024' => 2.58, 'hasil_produksi_2024' => 0.01],
            ['lokasi' => 'TENGGILIS UTARA', 'bahan_masuk_2025' => 2.83, 'diolah_selain_kompos_2025' => 0.87, 'diolah_untuk_kompos_2025' => 1.96, 'hasil_produksi_2025' => 0.41, 'bahan_masuk_2024' => 2.51, 'diolah_selain_kompos_2024' => 0.77, 'diolah_untuk_kompos_2024' => 1.74, 'hasil_produksi_2024' => 0.34],
            ['lokasi' => 'TENGGILIS', 'bahan_masuk_2025' => 4.21, 'diolah_selain_kompos_2025' => 0.93, 'diolah_untuk_kompos_2025' => 3.28, 'hasil_produksi_2025' => 0.32, 'bahan_masuk_2024' => 3.93, 'diolah_selain_kompos_2024' => 0.78, 'diolah_untuk_kompos_2024' => 3.15, 'hasil_produksi_2024' => 0.40],
            ['lokasi' => 'GAYUNGSARI', 'bahan_masuk_2025' => 1.79, 'diolah_selain_kompos_2025' => 0.52, 'diolah_untuk_kompos_2025' => 1.26, 'hasil_produksi_2025' => 0.22, 'bahan_masuk_2024' => 1.64, 'diolah_selain_kompos_2024' => 0.49, 'diolah_untuk_kompos_2024' => 1.14, 'hasil_produksi_2024' => 0.27],
            ['lokasi' => 'BIBIS KARAH', 'bahan_masuk_2025' => 1.34, 'diolah_selain_kompos_2025' => 0.39, 'diolah_untuk_kompos_2025' => 0.95, 'hasil_produksi_2025' => 0.14, 'bahan_masuk_2024' => 1.15, 'diolah_selain_kompos_2024' => 0.35, 'diolah_untuk_kompos_2024' => 0.79, 'hasil_produksi_2024' => 0.15],
            ['lokasi' => 'JAMBANGAN', 'bahan_masuk_2025' => 6.18, 'diolah_selain_kompos_2025' => 1.27, 'diolah_untuk_kompos_2025' => 4.91, 'hasil_produksi_2025' => 0.43, 'bahan_masuk_2024' => 6.23, 'diolah_selain_kompos_2024' => 1.30, 'diolah_untuk_kompos_2024' => 4.93, 'hasil_produksi_2024' => 0.39],
            ['lokasi' => 'BALAS KLUMPRIK', 'bahan_masuk_2025' => 1.81, 'diolah_selain_kompos_2025' => 0.57, 'diolah_untuk_kompos_2025' => 1.23, 'hasil_produksi_2025' => 0.14, 'bahan_masuk_2024' => 1.48, 'diolah_selain_kompos_2024' => 0.45, 'diolah_untuk_kompos_2024' => 1.03, 'hasil_produksi_2024' => 0.06],
            ['lokasi' => 'GUNUNGSARI', 'bahan_masuk_2025' => 1.78, 'diolah_selain_kompos_2025' => 0.53, 'diolah_untuk_kompos_2025' => 1.24, 'hasil_produksi_2025' => 0.18, 'bahan_masuk_2024' => 1.38, 'diolah_selain_kompos_2024' => 0.43, 'diolah_untuk_kompos_2024' => 0.95, 'hasil_produksi_2024' => 0.15],
            ['lokasi' => 'PUTAT JAYA', 'bahan_masuk_2025' => 0.54, 'diolah_selain_kompos_2025' => 0.15, 'diolah_untuk_kompos_2025' => 0.39, 'hasil_produksi_2025' => 0.03, 'bahan_masuk_2024' => 0.57, 'diolah_selain_kompos_2024' => 0.16, 'diolah_untuk_kompos_2024' => 0.41, 'hasil_produksi_2024' => 0.02],
            ['lokasi' => 'SONOKWIJENAN', 'bahan_masuk_2025' => 3.11, 'diolah_selain_kompos_2025' => 0.96, 'diolah_untuk_kompos_2025' => 2.14, 'hasil_produksi_2025' => 0.36, 'bahan_masuk_2024' => 2.47, 'diolah_selain_kompos_2024' => 0.76, 'diolah_untuk_kompos_2024' => 1.71, 'hasil_produksi_2024' => 0.41],
            ['lokasi' => 'TUBANAN', 'bahan_masuk_2025' => 0.30, 'diolah_selain_kompos_2025' => 0.07, 'diolah_untuk_kompos_2025' => 0.23, 'hasil_produksi_2025' => 0.02, 'bahan_masuk_2024' => 0.46, 'diolah_selain_kompos_2024' => 0.12, 'diolah_untuk_kompos_2024' => 0.33, 'hasil_produksi_2024' => 0.03],
            ['lokasi' => 'RUNGKUT MERR', 'bahan_masuk_2025' => 4.75, 'diolah_selain_kompos_2025' => 1.54, 'diolah_untuk_kompos_2025' => 3.22, 'hasil_produksi_2025' => 0.15, 'bahan_masuk_2024' => 5.22, 'diolah_selain_kompos_2024' => 1.69, 'diolah_untuk_kompos_2024' => 3.53, 'hasil_produksi_2024' => 0.29],
            ['lokasi' => 'IPLT KEPUTIH', 'bahan_masuk_2025' => 2.33, 'diolah_selain_kompos_2025' => 0.74, 'diolah_untuk_kompos_2025' => 1.60, 'hasil_produksi_2025' => 0.25, 'bahan_masuk_2024' => 1.81, 'diolah_selain_kompos_2024' => 0.57, 'diolah_untuk_kompos_2024' => 1.23, 'hasil_produksi_2024' => 0.16],
            ['lokasi' => 'BABAT JERAWAT', 'bahan_masuk_2025' => 2.40, 'diolah_selain_kompos_2025' => 0.74, 'diolah_untuk_kompos_2025' => 1.66, 'hasil_produksi_2025' => 0.23, 'bahan_masuk_2024' => 2.89, 'diolah_selain_kompos_2024' => 0.95, 'diolah_untuk_kompos_2024' => 1.94, 'hasil_produksi_2024' => 0.20],
            ['lokasi' => 'MEDOKAN AYU', 'bahan_masuk_2025' => 2.93, 'diolah_selain_kompos_2025' => 0.93, 'diolah_untuk_kompos_2025' => 2.00, 'hasil_produksi_2025' => 0.20, 'bahan_masuk_2024' => 2.95, 'diolah_selain_kompos_2024' => 0.94, 'diolah_untuk_kompos_2024' => 2.01, 'hasil_produksi_2024' => 0.23],
            ['lokasi' => 'JANGKAR', 'bahan_masuk_2025' => 3.37, 'diolah_selain_kompos_2025' => 1.10, 'diolah_untuk_kompos_2025' => 2.27, 'hasil_produksi_2025' => 0.25, 'bahan_masuk_2024' => 2.70, 'diolah_selain_kompos_2024' => 0.85, 'diolah_untuk_kompos_2024' => 1.84, 'hasil_produksi_2024' => 0.24],
            ['lokasi' => 'KYAI TAMBAK DERES', 'bahan_masuk_2025' => 0.00, 'diolah_selain_kompos_2025' => 0.00, 'diolah_untuk_kompos_2025' => 0.00, 'hasil_produksi_2025' => 0.00, 'bahan_masuk_2024' => 0.00, 'diolah_selain_kompos_2024' => 0.00, 'diolah_untuk_kompos_2024' => 0.00, 'hasil_produksi_2024' => 0.02],
            ['lokasi' => 'WONOREJO II', 'bahan_masuk_2025' => 27.35, 'diolah_selain_kompos_2025' => 4.87, 'diolah_untuk_kompos_2025' => 22.48, 'hasil_produksi_2025' => 1.33, 'bahan_masuk_2024' => 31.63, 'diolah_selain_kompos_2024' => 5.67, 'diolah_untuk_kompos_2024' => 25.96, 'hasil_produksi_2024' => 1.72],
            ['lokasi' => 'TAMBAK WEDI', 'bahan_masuk_2025' => 2.46, 'diolah_selain_kompos_2025' => 0.78, 'diolah_untuk_kompos_2025' => 1.68, 'hasil_produksi_2025' => 0.25, 'bahan_masuk_2024' => 2.00, 'diolah_selain_kompos_2024' => 0.66, 'diolah_untuk_kompos_2024' => 1.34, 'hasil_produksi_2024' => 0.26],
            ['lokasi' => 'MBAH RATU', 'bahan_masuk_2025' => 1.27, 'diolah_selain_kompos_2025' => 0.39, 'diolah_untuk_kompos_2025' => 0.88, 'hasil_produksi_2025' => 0.20, 'bahan_masuk_2024' => 1.52, 'diolah_selain_kompos_2024' => 0.49, 'diolah_untuk_kompos_2024' => 1.03, 'hasil_produksi_2024' => 0.24],
            ['lokasi' => 'NGINDEN', 'bahan_masuk_2025' => 2.10, 'diolah_selain_kompos_2025' => 0.64, 'diolah_untuk_kompos_2025' => 1.46, 'hasil_produksi_2025' => 0.22, 'bahan_masuk_2024' => 1.36, 'diolah_selain_kompos_2024' => 0.40, 'diolah_untuk_kompos_2024' => 0.96, 'hasil_produksi_2024' => 0.11],
        ];

        DB::table('kompos_lokasi')->truncate();
        DB::table('kompos_lokasi')->insert($data);
    }
}