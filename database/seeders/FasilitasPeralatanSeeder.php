<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Data Fasilitas & Aset (Peralatan Operasional) untuk Dashboard Statistik Lingkungan.
 * Sesuai tampilan: Komposisi Aset 350 Unit (39.7%, 20.6%, 12.3%, 27.4%).
 */
class FasilitasPeralatanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $data = [
            [
                'tipe_peralatan' => 'Mesin Pompa Alkon',
                'jenis_bbm' => 'Pertamax',
                'jumlah_total' => 139,
                'jumlah_beroperasi' => 112,
                'jumlah_rusak' => 27,
                'jumlah_cadangan' => 0,
                'kebutuhan_per_unit_pertamax' => 5,
                'kebutuhan_per_unit_dexlite' => null,
                'kebutuhan_1_tahun_pertamax' => 204400.00,
                'kebutuhan_1_tahun_dexlite' => null,
                'keterangan' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tipe_peralatan' => 'Mesin Chainsaw',
                'jenis_bbm' => 'Pertamax',
                'jumlah_total' => 72,
                'jumlah_beroperasi' => 43,
                'jumlah_rusak' => 29,
                'jumlah_cadangan' => 0,
                'kebutuhan_per_unit_pertamax' => 5,
                'kebutuhan_per_unit_dexlite' => null,
                'kebutuhan_1_tahun_pertamax' => 78475.00,
                'kebutuhan_1_tahun_dexlite' => null,
                'keterangan' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tipe_peralatan' => 'Polesaw',
                'jenis_bbm' => 'Pertamax',
                'jumlah_total' => 43,
                'jumlah_beroperasi' => 29,
                'jumlah_rusak' => 14,
                'jumlah_cadangan' => 0,
                'kebutuhan_per_unit_pertamax' => 2,
                'kebutuhan_per_unit_dexlite' => null,
                'kebutuhan_1_tahun_pertamax' => 21170.00,
                'kebutuhan_1_tahun_dexlite' => null,
                'keterangan' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tipe_peralatan' => 'Mesin Potong Rumput Gendong',
                'jenis_bbm' => 'Pertamax',
                'jumlah_total' => 96,
                'jumlah_beroperasi' => 67,
                'jumlah_rusak' => 29,
                'jumlah_cadangan' => 0,
                'kebutuhan_per_unit_pertamax' => 3,
                'kebutuhan_per_unit_dexlite' => null,
                'kebutuhan_1_tahun_pertamax' => 73365.00,
                'kebutuhan_1_tahun_dexlite' => null,
                'keterangan' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        if (DB::table('kebutuhan_bbm_peralatan_operasionals')->exists()) {
            DB::table('kebutuhan_bbm_peralatan_operasionals')->truncate();
        }
        DB::table('kebutuhan_bbm_peralatan_operasionals')->insert($data);
    }
}
