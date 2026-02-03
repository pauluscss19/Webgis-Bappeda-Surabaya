<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SarprasSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data BBM Kendaraan
        $bbmKendaraan = [
            ['tipe_kendaraan' => 'Pick Up', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 7, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 6, 'kebutuhan_per_unit_pertamax' => 10, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 21900.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null],
            ['tipe_kendaraan' => 'Pick Up', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 28, 'jumlah_rusak' => 5, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 23, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 10, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 83950.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Roda Tiga', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 26, 'jumlah_rusak' => 11, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 15, 'kebutuhan_per_unit_pertamax' => 2, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 10950.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null],
            ['tipe_kendaraan' => 'Sky Walker', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 10, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 9, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 15, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 49275.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Truck Tangki Air', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 39, 'jumlah_rusak' => 8, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 31, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 20, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 226300.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Truck Bak', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 3, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 3, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 15, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 16425.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Station Wagon', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 3, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 2, 'kebutuhan_per_unit_pertamax' => 8, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 5840.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null],
            ['tipe_kendaraan' => 'Dump Truck', 'jenis_bbm' => 'Solar', 'jumlah_total' => 9, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 9, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => 'BBM dianggarkan Bid. Kebersihan'],
            ['tipe_kendaraan' => 'Roda Dua', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 7, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 7, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => 'BBM dianggarkan Sekretariat'],
        ];
        DB::table('kebutuhan_bbm_kendaraan_operasionals')->insert($bbmKendaraan);

        // 2. Data BBM Peralatan
        $bbmPeralatan = [
            ['tipe_peralatan' => 'Mesin Pompa Alkon', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 139, 'jumlah_rusak' => 27, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 112, 'kebutuhan_per_unit_pertamax' => 5, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 204400.00, 'kebutuhan_1_tahun_dexlite' => null],
            ['tipe_peralatan' => 'Mesin Chainsaw', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 72, 'jumlah_rusak' => 29, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 43, 'kebutuhan_per_unit_pertamax' => 5, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 78475.00, 'kebutuhan_1_tahun_dexlite' => null],
            ['tipe_peralatan' => 'PoleSaw', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 43, 'jumlah_rusak' => 14, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 29, 'kebutuhan_per_unit_pertamax' => 2, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 21170.00, 'kebutuhan_1_tahun_dexlite' => null],
            ['tipe_peralatan' => 'Mesin Potong Rumput Gendong', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 96, 'jumlah_rusak' => 29, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 67, 'kebutuhan_per_unit_pertamax' => 3, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 73365.00, 'kebutuhan_1_tahun_dexlite' => null],
        ];
        DB::table('kebutuhan_bbm_peralatan_operasionals')->insert($bbmPeralatan);

        // 3. Data CSR
        $csrData = [
            ['lokasi' => 'Taman Jemursari (Air Mancur)', 'penanggung_jawab' => 'PT Adhi Kartika', 'bulan' => 'Januari', 'tahun' => 2024],
            ['lokasi' => 'Taman Rotonde Mayangkara', 'penanggung_jawab' => 'PT Adhi Kartika', 'bulan' => 'Januari', 'tahun' => 2024],
            ['lokasi' => 'Taman Jalur Hijau Jalan Mayjend Yonosoewoyo', 'penanggung_jawab' => 'CV Lentera Media', 'bulan' => 'Februari', 'tahun' => 2024],
            ['lokasi' => 'Jalan Dr. Soetomo Pulau 1, Surabaya (Perempatan Traffic Light Darmo - Dr. Soetomo)', 'penanggung_jawab' => 'PT Warna Warni Media', 'bulan' => 'Maret', 'tahun' => 2024],
            ['lokasi' => 'Jalan Tunjungan - Pahlawan (Pos Polisi di depan Siola)', 'penanggung_jawab' => 'PT Warna Warni Media', 'bulan' => 'Maret', 'tahun' => 2024],
            ['lokasi' => 'Jalan Blauran - Praban (Pos Polisi di depan BG Junction)', 'penanggung_jawab' => 'PT Warna Warni Media', 'bulan' => 'Maret', 'tahun' => 2024],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan Urip Sumoharjo - Basuki Rahmat', 'penanggung_jawab' => 'PT Warna Warni Media', 'bulan' => 'April', 'tahun' => 2024],
            ['lokasi' => 'Taman Jalur Hijau di Jalan Diponegoro', 'penanggung_jawab' => 'Bank Jatim', 'bulan' => 'Juni', 'tahun' => 2024],
            ['lokasi' => 'Taman Bungkul', 'penanggung_jawab' => 'Telkom Indonesia Regional 5', 'bulan' => 'Juli', 'tahun' => 2024],
            ['lokasi' => 'Taman Kota Glampark Mozaik', 'penanggung_jawab' => 'Rotary Club Kaliasin Rotary Global Grant #GG2457789', 'bulan' => 'Agustus', 'tahun' => 2024],
            ['lokasi' => 'Taman Jalur Hijau di Jalan Diponegoro', 'penanggung_jawab' => 'CV Standard Agency', 'bulan' => 'Oktober', 'tahun' => 2024],
            ['lokasi' => 'Taman Jalur Hijau di Jalan Diponegoro', 'penanggung_jawab' => 'CV General Majesty', 'bulan' => 'November', 'tahun' => 2024],
            ['lokasi' => 'Taman Jalur Hijau Jalan Mayjend Sungkono', 'penanggung_jawab' => 'CV Vision Media', 'bulan' => 'Desember', 'tahun' => 2024],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan Ahmad Yani', 'penanggung_jawab' => 'CV Sembilan Karya Anugerah Kemenangan', 'bulan' => 'Januari', 'tahun' => 2025],
            ['lokasi' => 'Taman Jalur Hijau di Jalan Diponegoro', 'penanggung_jawab' => 'PT Wings Surya', 'bulan' => 'Februari', 'tahun' => 2025],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan HR. Muhammad', 'penanggung_jawab' => 'CV Tujuh Tujuh Bangkit Jaya', 'bulan' => 'Maret', 'tahun' => 2025],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan Bintang Diponggo', 'penanggung_jawab' => 'Gereja Bethel Indonesia Gibeon', 'bulan' => 'April', 'tahun' => 2025],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan HR. Muhammad', 'penanggung_jawab' => 'CV Tujuh Tujuh Bangkit Jaya', 'bulan' => 'Mei', 'tahun' => 2025],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan Blauran - Praban (Pos Polisi BG Junction)', 'penanggung_jawab' => 'PT Warna Warni Media', 'bulan' => 'Mei', 'tahun' => 2025],
            ['lokasi' => 'Taman/Jalur Hijau di Jalan Urip Sumoharjo - Basuki Rahmat (Pos Polisi Karapan Sapi)', 'penanggung_jawab' => 'PT Warna Warni Media', 'bulan' => 'Mei', 'tahun' => 2025],
        ];
        DB::table('rth_skema_csrs')->insert($csrData);
    }
}