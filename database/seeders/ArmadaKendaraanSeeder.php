<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Data Armada (Kendaraan Operasional) untuk tab Armada & Logistik - Data Statistik.
 */
class ArmadaKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $data = [
            ['tipe_kendaraan' => 'Pick Up', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 7, 'jumlah_beroperasi' => 6, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => 10, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 21900.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Pick Up', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 28, 'jumlah_beroperasi' => 23, 'jumlah_rusak' => 5, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 10, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 83950.00, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Roda Tiga', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 26, 'jumlah_beroperasi' => 15, 'jumlah_rusak' => 11, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => 2, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 10950.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Sky Walker', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 10, 'jumlah_beroperasi' => 9, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 15, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 49275.00, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Truck Tangki Air', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 39, 'jumlah_beroperasi' => 31, 'jumlah_rusak' => 8, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 20, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 226300.00, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Truck Bak', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 3, 'jumlah_beroperasi' => 3, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 15, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 16425.00, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Station Wagon', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 3, 'jumlah_beroperasi' => 2, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => 8, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 5840.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null, 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Dump Truck', 'jenis_bbm' => 'Solar', 'jumlah_total' => 9, 'jumlah_beroperasi' => 9, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => 'BBM dianggarkan Bid. Kebersihan', 'created_at' => $now, 'updated_at' => $now],
            ['tipe_kendaraan' => 'Roda Dua', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 7, 'jumlah_beroperasi' => 7, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => 'BBM dianggarkan Sekretariat', 'created_at' => $now, 'updated_at' => $now],
        ];

        if (DB::table('kebutuhan_bbm_kendaraan_operasionals')->exists()) {
            DB::table('kebutuhan_bbm_kendaraan_operasionals')->truncate();
        }
        DB::table('kebutuhan_bbm_kendaraan_operasionals')->insert($data);
    }
}
