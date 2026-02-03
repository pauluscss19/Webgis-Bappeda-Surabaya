<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RthTamanMakamSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Rekapitulasi RTH Taman
        $dataTaman = [
            ['wilayah' => 'Barat',   'jumlah_taman_pasif_jalur_hijau' => 97,  'luas_taman_pasif_jalur_hijau' => 541307.95, 'jumlah_taman_aktif' => 41, 'luas_taman_aktif' => 14256.64, 'jumlah_taman_kota' => 2,  'luas_taman_kota' => 17135.32,  'jumlah_per_wilayah' => 140, 'luas_per_wilayah' => 572699.91],
            ['wilayah' => 'Pusat',   'jumlah_taman_pasif_jalur_hijau' => 178, 'luas_taman_pasif_jalur_hijau' => 226223.12, 'jumlah_taman_aktif' => 11, 'luas_taman_aktif' => 21576.47, 'jumlah_taman_kota' => 8,  'luas_taman_kota' => 46818.57,  'jumlah_per_wilayah' => 197, 'luas_per_wilayah' => 294618.16],
            ['wilayah' => 'Selatan', 'jumlah_taman_pasif_jalur_hijau' => 153, 'luas_taman_pasif_jalur_hijau' => 595368.70, 'jumlah_taman_aktif' => 25, 'luas_taman_aktif' => 13108.21, 'jumlah_taman_kota' => 11, 'luas_taman_kota' => 41772.96,  'jumlah_per_wilayah' => 189, 'luas_per_wilayah' => 650249.87],
            ['wilayah' => 'Timur',   'jumlah_taman_pasif_jalur_hijau' => 219, 'luas_taman_pasif_jalur_hijau' => 579527.99, 'jumlah_taman_aktif' => 48, 'luas_taman_aktif' => 34688.80, 'jumlah_taman_kota' => 12, 'luas_taman_kota' => 474407.30, 'jumlah_per_wilayah' => 279, 'luas_per_wilayah' => 1088624.09],
            ['wilayah' => 'Utara',   'jumlah_taman_pasif_jalur_hijau' => 147, 'luas_taman_pasif_jalur_hijau' => 165576.25, 'jumlah_taman_aktif' => 14, 'luas_taman_aktif' => 11958.24, 'jumlah_taman_kota' => 6,  'luas_taman_kota' => 25908.94,  'jumlah_per_wilayah' => 167, 'luas_per_wilayah' => 203443.43],
        ];
        DB::table('rekapitulasi_rth_tamans')->insert($dataTaman);

        // 2. Data Rekapitulasi RTH Makam
        $dataMakam = [
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
        ];
        DB::table('rekapitulasi_rth_makams')->insert($dataMakam);

        // 3. Data Kapasitas Makam
        $dataKapasitas = [
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
        ];
        DB::table('kapasitas_makams')->insert($dataKapasitas);
    }
}