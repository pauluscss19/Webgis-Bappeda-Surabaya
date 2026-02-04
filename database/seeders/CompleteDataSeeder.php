<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompleteDataSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. DATA RTH TAMAN (Rekapitulasi)
        // ==========================================
        DB::table('rekapitulasi_rth_tamans')->truncate(); // Hapus data lama biar gak dobel
        DB::table('rekapitulasi_rth_tamans')->insert([
            ['wilayah' => 'Barat',   'jumlah_taman_pasif_jalur_hijau' => 97,  'luas_taman_pasif_jalur_hijau' => 541307.95, 'jumlah_taman_aktif' => 41, 'luas_taman_aktif' => 14256.64, 'jumlah_taman_kota' => 2,  'luas_taman_kota' => 17135.32,  'jumlah_per_wilayah' => 140, 'luas_per_wilayah' => 572699.91],
            ['wilayah' => 'Pusat',   'jumlah_taman_pasif_jalur_hijau' => 178, 'luas_taman_pasif_jalur_hijau' => 226223.12, 'jumlah_taman_aktif' => 11, 'luas_taman_aktif' => 21576.47, 'jumlah_taman_kota' => 8,  'luas_taman_kota' => 46818.57,  'jumlah_per_wilayah' => 197, 'luas_per_wilayah' => 294618.16],
            ['wilayah' => 'Selatan', 'jumlah_taman_pasif_jalur_hijau' => 153, 'luas_taman_pasif_jalur_hijau' => 595368.70, 'jumlah_taman_aktif' => 25, 'luas_taman_aktif' => 13108.21, 'jumlah_taman_kota' => 11, 'luas_taman_kota' => 41772.96,  'jumlah_per_wilayah' => 189, 'luas_per_wilayah' => 650249.87],
            ['wilayah' => 'Timur',   'jumlah_taman_pasif_jalur_hijau' => 219, 'luas_taman_pasif_jalur_hijau' => 579527.99, 'jumlah_taman_aktif' => 48, 'luas_taman_aktif' => 34688.80, 'jumlah_taman_kota' => 12, 'luas_taman_kota' => 474407.30, 'jumlah_per_wilayah' => 279, 'luas_per_wilayah' => 1088624.09],
            ['wilayah' => 'Utara',   'jumlah_taman_pasif_jalur_hijau' => 147, 'luas_taman_pasif_jalur_hijau' => 165576.25, 'jumlah_taman_aktif' => 14, 'luas_taman_aktif' => 11958.24, 'jumlah_taman_kota' => 6,  'luas_taman_kota' => 25908.94,  'jumlah_per_wilayah' => 167, 'luas_per_wilayah' => 203443.43],
        ]);

        // ==========================================
        // 2. DATA RTH MAKAM (Luas)
        // ==========================================
        DB::table('rekapitulasi_rth_makams')->truncate();
        DB::table('rekapitulasi_rth_makams')->insert([
            ['nama_makam' => 'MI. Asem Jajar', 'luas' => 25012.53],
            ['nama_makam' => 'MI. Kalianak', 'luas' => 56119.00],
            ['nama_makam' => 'MI. Kapas Krampung', 'luas' => 95516.14],
            ['nama_makam' => 'MI. Karang Tembok', 'luas' => 78003.67],
            ['nama_makam' => 'MI. Ngagel Rejo', 'luas' => 50051.58],
            ['nama_makam' => 'MI. Tembok Gede', 'luas' => 124217.00],
            ['nama_makam' => 'Mk. Belanda Peneleh', 'luas' => 44986.79],
            ['nama_makam' => 'MK. Kembang Kuning', 'luas' => 264088.37],
            ['nama_makam' => 'MT. Simo Kwagean', 'luas' => 74793.77],
            ['nama_makam' => 'MU. Putat Gede', 'luas' => 107099.83],
            ['nama_makam' => 'MU. Wonokusumo Kidul', 'luas' => 47696.00],
            ['nama_makam' => 'TPU Babat Jerawat', 'luas' => 93260.00],
            ['nama_makam' => 'TPU Keputih', 'luas' => 409300.00],
            ['nama_makam' => 'Krematorium Keputih', 'luas' => 19806.01],
        ]);

        // ==========================================
        // 3. DATA KAPASITAS MAKAM (Detail)
        // ==========================================
        DB::table('kapasitas_makams')->truncate();
        DB::table('kapasitas_makams')->insert([
            ['nama_lokasi' => 'TPU Keputih', 'tahun_operasional' => '2003', 'kelurahan' => 'a. Keputih, b. Medokan Semampir', 'kecamatan' => 'Sukolilo', 'luas' => 409300.00, 'luas_fasum' => 97881.47, 'luas_lahan_efektif' => 311419, 'kapasitas_makam' => '59318', 'jumlah_data_kematian' => 38057, 'sisa_petak' => 21261, 'keterangan' => 'Tersedia', 'jumlah_pegawai' => 34],
            ['nama_lokasi' => 'TPU Babat Jerawat', 'tahun_operasional' => '2005', 'kelurahan' => 'a. Sememi, b. Babat Jerawat', 'kecamatan' => 'a. Benowo, b. Pakal', 'luas' => 93260.00, 'luas_fasum' => 23617.00, 'luas_lahan_efektif' => 69643, 'kapasitas_makam' => '16883', 'jumlah_data_kematian' => 17272, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 20],
            ['nama_lokasi' => 'MK Kembang Kuning', 'tahun_operasional' => '1916', 'kelurahan' => 'Pakis', 'kecamatan' => 'Sawahan', 'luas' => 264088.37, 'luas_fasum' => 11107.20, 'luas_lahan_efektif' => 252981, 'kapasitas_makam' => '72280', 'jumlah_data_kematian' => 81331, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 16],
            ['nama_lokasi' => 'MU Putat Gede', 'tahun_operasional' => '1948', 'kelurahan' => 'Putat Jaya', 'kecamatan' => 'Sawahan', 'luas' => 107099.83, 'luas_fasum' => 3527.00, 'luas_lahan_efektif' => 103573, 'kapasitas_makam' => '51786', 'jumlah_data_kematian' => 50764, 'sisa_petak' => 1022, 'keterangan' => 'Tersedia, Sedikit', 'jumlah_pegawai' => 14],
            ['nama_lokasi' => 'MT Simo Kwagean', 'tahun_operasional' => '1959', 'kelurahan' => 'Putat Jaya', 'kecamatan' => 'Sawahan', 'luas' => 74793.77, 'luas_fasum' => 3614.00, 'luas_lahan_efektif' => 71180, 'kapasitas_makam' => '10624', 'jumlah_data_kematian' => 5974, 'sisa_petak' => 4650, 'keterangan' => 'Tersedia', 'jumlah_pegawai' => 5],
            ['nama_lokasi' => 'MI Kalianak', 'tahun_operasional' => '1971', 'kelurahan' => 'Morokrembangan', 'kecamatan' => 'Krembangan', 'luas' => 56119.00, 'luas_fasum' => 3381.35, 'luas_lahan_efektif' => 52738, 'kapasitas_makam' => '26369', 'jumlah_data_kematian' => 54502, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 14],
            ['nama_lokasi' => 'MI Asem Jajar', 'tahun_operasional' => '1958', 'kelurahan' => 'Tembok Dukuh', 'kecamatan' => 'Bubutan', 'luas' => 25012.53, 'luas_fasum' => 3236.93, 'luas_lahan_efektif' => 21776, 'kapasitas_makam' => '10888', 'jumlah_data_kematian' => 22181, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 7],
            ['nama_lokasi' => 'MI Karang Tembok', 'tahun_operasional' => '1942', 'kelurahan' => 'Pegirian', 'kecamatan' => 'Semampir', 'luas' => 78003.67, 'luas_fasum' => 3077.91, 'luas_lahan_efektif' => 74926, 'kapasitas_makam' => '35679', 'jumlah_data_kematian' => 35970, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 9],
            ['nama_lokasi' => 'MU Wonokusumo Kidul', 'tahun_operasional' => '1961', 'kelurahan' => 'Pegirian', 'kecamatan' => 'Semampir', 'luas' => 47696.00, 'luas_fasum' => 4806.29, 'luas_lahan_efektif' => 42890, 'kapasitas_makam' => '19495', 'jumlah_data_kematian' => 13576, 'sisa_petak' => 5919, 'keterangan' => 'Tersedia', 'jumlah_pegawai' => 4],
            ['nama_lokasi' => 'MI Kapas Krampung', 'tahun_operasional' => '1950', 'kelurahan' => 'a. Simokerto, b. Tambak Rejo, c. Kapas Madya Baru', 'kecamatan' => 'a. Simokerto, b. Tambaksari', 'luas' => 95516.14, 'luas_fasum' => 3822.90, 'luas_lahan_efektif' => 91693, 'kapasitas_makam' => '68942', 'jumlah_data_kematian' => 68729, 'sisa_petak' => 213, 'keterangan' => 'Tersedia, Sedikit', 'jumlah_pegawai' => 12],
            ['nama_lokasi' => 'M Belanda Peneleh', 'tahun_operasional' => '1848', 'kelurahan' => 'Peneleh', 'kecamatan' => 'Genteng', 'luas' => 44986.79, 'luas_fasum' => 11142.30, 'luas_lahan_efektif' => 33844, 'kapasitas_makam' => '8205', 'jumlah_data_kematian' => 11885, 'sisa_petak' => null, 'keterangan' => 'Tidak Aktif', 'jumlah_pegawai' => 5],
            ['nama_lokasi' => 'MI Tembok Gede', 'tahun_operasional' => '1905', 'kelurahan' => 'Tembok Dukuh', 'kecamatan' => 'Bubutan', 'luas' => 124217.00, 'luas_fasum' => 4183.50, 'luas_lahan_efektif' => 120034, 'kapasitas_makam' => '60017', 'jumlah_data_kematian' => 62778, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 12],
            ['nama_lokasi' => 'MI Ngagel Rejo', 'tahun_operasional' => '1943', 'kelurahan' => 'a. Ngagel Rejo, b. Pucang Sewu', 'kecamatan' => 'a. Wonokromo, b. Gubeng', 'luas' => 50051.58, 'luas_fasum' => 4054.95, 'luas_lahan_efektif' => 45997, 'kapasitas_makam' => '45997', 'jumlah_data_kematian' => 53893, 'sisa_petak' => null, 'keterangan' => 'Penuh, Tumpang', 'jumlah_pegawai' => 9],
            ['nama_lokasi' => 'Krematorium Keputih', 'tahun_operasional' => 'Juni 2019', 'kelurahan' => 'Keputih', 'kecamatan' => 'Sukolilo', 'luas' => 19806.01, 'luas_fasum' => 4685.69, 'luas_lahan_efektif' => 15120, 'kapasitas_makam' => 'Kremasi', 'jumlah_data_kematian' => 2802, 'sisa_petak' => null, 'keterangan' => 'Pelayanan Kremasi', 'jumlah_pegawai' => 7],
        ]);

        // ==========================================
        // 4. DATA BBM KENDARAAN (Sarpras)
        // ==========================================
        DB::table('kebutuhan_bbm_kendaraan_operasionals')->truncate();
        DB::table('kebutuhan_bbm_kendaraan_operasionals')->insert([
            ['tipe_kendaraan' => 'Pick Up', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 7, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 6, 'kebutuhan_per_unit_pertamax' => 10, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 21900.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null],
            ['tipe_kendaraan' => 'Pick Up', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 28, 'jumlah_rusak' => 5, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 23, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 10, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 83950.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Roda Tiga', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 26, 'jumlah_rusak' => 11, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 15, 'kebutuhan_per_unit_pertamax' => 2, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 10950.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null],
            ['tipe_kendaraan' => 'Sky Walker', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 10, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 9, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 15, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 49275.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Truck Tangki Air', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 39, 'jumlah_rusak' => 8, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 31, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 20, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 226300.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Truck Bak', 'jenis_bbm' => 'Dexlite', 'jumlah_total' => 3, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 3, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => 15, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => 16425.00, 'keterangan' => null],
            ['tipe_kendaraan' => 'Station Wagon', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 3, 'jumlah_rusak' => 1, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 2, 'kebutuhan_per_unit_pertamax' => 8, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 5840.00, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => null],
            ['tipe_kendaraan' => 'Dump Truck', 'jenis_bbm' => 'Solar', 'jumlah_total' => 9, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 9, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => 'BBM dianggarkan Bid. Kebersihan'],
            ['tipe_kendaraan' => 'Roda Dua', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 7, 'jumlah_rusak' => 0, 'jumlah_cadangan' => null, 'jumlah_beroperasi' => 7, 'kebutuhan_per_unit_pertamax' => null, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => null, 'kebutuhan_1_tahun_dexlite' => null, 'keterangan' => 'BBM dianggarkan Sekretariat'],
        ]);

        // ==========================================
        // 5. DATA BBM PERALATAN (Sarpras)
        // ==========================================
        DB::table('kebutuhan_bbm_peralatan_operasionals')->truncate();
        DB::table('kebutuhan_bbm_peralatan_operasionals')->insert([
            ['tipe_peralatan' => 'Mesin Pompa Alkon', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 139, 'jumlah_rusak' => 27, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 112, 'kebutuhan_per_unit_pertamax' => 5, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 204400.00, 'kebutuhan_1_tahun_dexlite' => null],
            ['tipe_peralatan' => 'Mesin Chainsaw', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 72, 'jumlah_rusak' => 29, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 43, 'kebutuhan_per_unit_pertamax' => 5, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 78475.00, 'kebutuhan_1_tahun_dexlite' => null],
            ['tipe_peralatan' => 'PoleSaw', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 43, 'jumlah_rusak' => 14, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 29, 'kebutuhan_per_unit_pertamax' => 2, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 21170.00, 'kebutuhan_1_tahun_dexlite' => null],
            ['tipe_peralatan' => 'Mesin Potong Rumput Gendong', 'jenis_bbm' => 'Pertamax', 'jumlah_total' => 96, 'jumlah_rusak' => 29, 'jumlah_cadangan' => 0, 'jumlah_beroperasi' => 67, 'kebutuhan_per_unit_pertamax' => 3, 'kebutuhan_per_unit_dexlite' => null, 'kebutuhan_1_tahun_pertamax' => 73365.00, 'kebutuhan_1_tahun_dexlite' => null],
        ]);

        // ==========================================
        // 6. DATA CSR (Corporate Social Responsibility)
        // ==========================================
        DB::table('rth_skema_csrs')->truncate();
        DB::table('rth_skema_csrs')->insert([
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
        ]);
    }
}