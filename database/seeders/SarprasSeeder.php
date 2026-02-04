<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SarprasSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tables = [
            'master_fasilitas_rinci',
            'master_bank_sampah',
            'laporan_tps3r_harian',
            'laporan_b3_rt',
            'master_armada',
            'laporan_bbm',
            'laporan_tpa_rekap'
        ];
        foreach ($tables as $tbl) {
            DB::table($tbl)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data_fasilitas = [];
        $data_bank = [];
        $data_tps3r = [];
        $data_b3 = [];
        $data_armada = [];
        $data_bbm = [];
        $data_tpa = [];

        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kalibutuh',
            'kode_fasilitas' => '1',
            'alamat' => 'Jl. Demak',
            'kecamatan' => 'Kec. Bubutan',
            'kelurahan' => 'Kel. Tembok Dukuh',
            'timbulan_sampah_masuk_kg' => 145080.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pirngadi',
            'kode_fasilitas' => '2',
            'alamat' => 'Jl. Pirngadi',
            'kecamatan' => 'Kec. Bubutan',
            'kelurahan' => 'Kel. Bubutan',
            'timbulan_sampah_masuk_kg' => 121640.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Penghela',
            'kode_fasilitas' => '3',
            'alamat' => 'Jl. Penghela',
            'kecamatan' => 'Kec. Bubutan',
            'kelurahan' => 'Kel. Bubutan',
            'timbulan_sampah_masuk_kg' => 229720.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sulung',
            'kode_fasilitas' => '4',
            'alamat' => 'Jl. Sulung Kali',
            'kecamatan' => 'Kec. Bubutan',
            'kelurahan' => 'Kel. Alon-alon Contong',
            'timbulan_sampah_masuk_kg' => 187300.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Dupak Prau',
            'kode_fasilitas' => '5',
            'alamat' => 'Jl. Babatan Dupak',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Jepara',
            'timbulan_sampah_masuk_kg' => 153550.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Simolawang',
            'kode_fasilitas' => '6',
            'alamat' => 'Jl. Simolawang',
            'kecamatan' => 'Kec. Simokerto',
            'kelurahan' => 'Kel. Simolawang',
            'timbulan_sampah_masuk_kg' => 368690.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Kapasan',
            'kode_fasilitas' => '7',
            'alamat' => 'Jl. Pasar Kapasan',
            'kecamatan' => 'Kec. Simokerto',
            'kelurahan' => 'Kel. Sidodadi',
            'timbulan_sampah_masuk_kg' => 81940.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tambak Rejo',
            'kode_fasilitas' => '8',
            'alamat' => 'Jl. Tambak Rejo',
            'kecamatan' => 'Kec. Simokerto',
            'kelurahan' => 'Kel. Tambak Rejo',
            'timbulan_sampah_masuk_kg' => 1580070.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Simpang Dukuh',
            'kode_fasilitas' => '9',
            'alamat' => 'Jl. Simpah Dukuh',
            'kecamatan' => 'Kec. Genteng',
            'kelurahan' => 'Kel. Genteng',
            'timbulan_sampah_masuk_kg' => 66160.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Genteng',
            'kode_fasilitas' => '10',
            'alamat' => 'Jl. Genteng Besar',
            'kecamatan' => 'Kec. Genteng',
            'kelurahan' => 'Kel. Genteng',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kayon',
            'kode_fasilitas' => '11',
            'alamat' => 'Jl. Kayun',
            'kecamatan' => 'Kec. Genteng',
            'kelurahan' => 'Kel. Embong Kaliasin',
            'timbulan_sampah_masuk_kg' => 327530.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Legundi Anggrek',
            'kode_fasilitas' => '12',
            'alamat' => 'Jl. Anggrek',
            'kecamatan' => 'Kec. Genteng',
            'kelurahan' => 'Kel. Ketabang',
            'timbulan_sampah_masuk_kg' => 357350.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Makam Peneleh',
            'kode_fasilitas' => '13',
            'alamat' => 'Jl. Makam Peneleh',
            'kecamatan' => 'Kec. Genteng',
            'kelurahan' => 'Kel. Peneleh',
            'timbulan_sampah_masuk_kg' => 230790.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kedondong',
            'kode_fasilitas' => '14',
            'alamat' => 'Jl. Kedondong',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Tegalsari',
            'timbulan_sampah_masuk_kg' => 361900.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kedung Anyar',
            'kode_fasilitas' => '15',
            'alamat' => 'Jl. Kedung Anyar',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Kedungdoro',
            'timbulan_sampah_masuk_kg' => 381530.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Kembang',
            'kode_fasilitas' => '16',
            'alamat' => 'Jl. Wonorejo III (Pasar kembang)',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Wonorejo',
            'timbulan_sampah_masuk_kg' => 185540.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Dinoyo',
            'kode_fasilitas' => '17',
            'alamat' => 'Jl. Dinoyo',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Keputran',
            'timbulan_sampah_masuk_kg' => 170870.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Taman Ketampon',
            'kode_fasilitas' => '18',
            'alamat' => 'Jl. Taman Ketampon',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Dr. Soetomo',
            'timbulan_sampah_masuk_kg' => 412980.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Keputran Utara II',
            'kode_fasilitas' => '19',
            'alamat' => 'Jl. Keputran',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Keputran',
            'timbulan_sampah_masuk_kg' => 117040.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tubanan',
            'kode_fasilitas' => '20',
            'alamat' => 'Jl. Simpang Darmo Permai',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Karangpoh',
            'timbulan_sampah_masuk_kg' => 410360.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Karang Poh',
            'kode_fasilitas' => '21',
            'alamat' => 'Jl. Darmo Indah Barat',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Karangpoh',
            'timbulan_sampah_masuk_kg' => 156840.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Balongsari',
            'kode_fasilitas' => '22',
            'alamat' => 'Jl. Balongsari Taman',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Balongsari',
            'timbulan_sampah_masuk_kg' => 96880.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Manukan Wetan',
            'kode_fasilitas' => '23',
            'alamat' => 'Jl. Sikatan / Pasar',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Manukan Wetan',
            'timbulan_sampah_masuk_kg' => 75430.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Manukan Kulon',
            'kode_fasilitas' => '24',
            'alamat' => 'Jl. Manukan Lor',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Manukan Kulon',
            'timbulan_sampah_masuk_kg' => 378600.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Manukan Kulon Baru',
            'kode_fasilitas' => '25',
            'alamat' => 'Jl. Manukan Kulon',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Manukan Kulon',
            'timbulan_sampah_masuk_kg' => 19920.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Manukan Telaga',
            'kode_fasilitas' => '26',
            'alamat' => 'Jl. Manukan Telaga',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Banjarsugihan',
            'timbulan_sampah_masuk_kg' => 76610.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Buntaran',
            'kode_fasilitas' => '27',
            'alamat' => 'Jl.Buntaran',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Manukan Wetan',
            'timbulan_sampah_masuk_kg' => 14610.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Darmo indah',
            'kode_fasilitas' => '28',
            'alamat' => 'Jl.Darmo indah',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Tandes',
            'timbulan_sampah_masuk_kg' => 82100.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Griya Citra Asri',
            'kode_fasilitas' => '29',
            'alamat' => 'Jl.Griya Citra Asri',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Kandangan',
            'timbulan_sampah_masuk_kg' => 1210.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tengger Kandangan',
            'kode_fasilitas' => '30',
            'alamat' => 'Jl. Raya Tengger',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Kandangan',
            'timbulan_sampah_masuk_kg' => 87840.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kandangan',
            'kode_fasilitas' => '31',
            'alamat' => 'Jl. Kandangan (RM. Pandan Sari)',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Kandangan',
            'timbulan_sampah_masuk_kg' => 8020.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Klakah Rejo',
            'kode_fasilitas' => '32',
            'alamat' => 'Jl. Klakah Rejo',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Kandangan',
            'timbulan_sampah_masuk_kg' => 69840.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kendung Makam',
            'kode_fasilitas' => '33',
            'alamat' => 'Jl. Sememi',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Sememi',
            'timbulan_sampah_masuk_kg' => 21990.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kendung BDH',
            'kode_fasilitas' => '34',
            'alamat' => 'Jl. Raya Kendung Benowo',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Sememi',
            'timbulan_sampah_masuk_kg' => 48110.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Sememi',
            'kode_fasilitas' => '35',
            'alamat' => 'Jl. Pasar Bandarejo Sememi',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Sememi',
            'timbulan_sampah_masuk_kg' => 116810.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Romo Kalisari',
            'kode_fasilitas' => '36',
            'alamat' => 'Jl. Romokalisari',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Romokalisari',
            'timbulan_sampah_masuk_kg' => 14750.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Rusun Romokalisari',
            'kode_fasilitas' => '37',
            'alamat' => 'Jl. Rusunawa Romokalisari',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Romokalisari',
            'timbulan_sampah_masuk_kg' => 31950.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Babat Jerawat',
            'kode_fasilitas' => '38',
            'alamat' => 'Jl. Babat Jerawat',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Babat Jerawat',
            'timbulan_sampah_masuk_kg' => 63590.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Langkir',
            'kode_fasilitas' => '39',
            'alamat' => 'Jl. Raya Babat Jerawat',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Babat Jerawat',
            'timbulan_sampah_masuk_kg' => 16630.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'PBI',
            'kode_fasilitas' => '40',
            'alamat' => 'Jl. Raya Sememi',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Babat Jerawat',
            'timbulan_sampah_masuk_kg' => 201250.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Benowo',
            'kode_fasilitas' => '41',
            'alamat' => 'Jl. Raya Benowo ( Pasar )',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Benowo',
            'timbulan_sampah_masuk_kg' => 54280.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Benowo Krajan',
            'kode_fasilitas' => '42',
            'alamat' => 'Jl. Benowo Krajan I',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Benowo',
            'timbulan_sampah_masuk_kg' => 13060.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jurang Kuping',
            'kode_fasilitas' => '43',
            'alamat' => 'Jl. Raya Jurang Kuping',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Benowo',
            'timbulan_sampah_masuk_kg' => 18160.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sumberejo',
            'kode_fasilitas' => '44',
            'alamat' => 'Jl. Sumberejo Makam',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Sumberejo',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Krenuk',
            'kode_fasilitas' => '45',
            'alamat' => 'Jl. Sumberejo pintu air',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Sumberejo',
            'timbulan_sampah_masuk_kg' => 33910.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pakal Sidorejo',
            'kode_fasilitas' => '46',
            'alamat' => 'Jl. Raya Pakal',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Pakal',
            'timbulan_sampah_masuk_kg' => 8560.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pakal madya',
            'kode_fasilitas' => '47',
            'alamat' => 'Jl. Pakal madya',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. pakal',
            'timbulan_sampah_masuk_kg' => 118060.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Lempung Perdana',
            'kode_fasilitas' => '48',
            'alamat' => 'Jl. Lempung Perdana',
            'kecamatan' => 'Kec. Sambikerep',
            'kelurahan' => 'Kel. Lontar',
            'timbulan_sampah_masuk_kg' => 78740.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Candi Lontar',
            'kode_fasilitas' => '49',
            'alamat' => 'Jl. Lempung Sari',
            'kecamatan' => 'Kec. Sambikerep',
            'kelurahan' => 'Kel. Lontar',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sawo Bringin',
            'kode_fasilitas' => '50',
            'alamat' => 'Jl. Sawo VI',
            'kecamatan' => 'Kec. Sambikerep',
            'kelurahan' => 'Kel. Bringin',
            'timbulan_sampah_masuk_kg' => 41700.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bringin',
            'kode_fasilitas' => '51',
            'alamat' => 'Jl. Bringin',
            'kecamatan' => 'Kec. Sambikerep',
            'kelurahan' => 'Kel. Bringin',
            'timbulan_sampah_masuk_kg' => 15730.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Alas Malang',
            'kode_fasilitas' => '52',
            'alamat' => 'Jl. Alas malang',
            'kecamatan' => 'Kec. Sambikerep',
            'kelurahan' => 'Kel. Bringin',
            'timbulan_sampah_masuk_kg' => 27130.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kuwukan',
            'kode_fasilitas' => '53',
            'alamat' => 'Jl. Kuwukan Sambikerep',
            'kecamatan' => 'Kec. Sambikerep',
            'kelurahan' => 'Kel. Sambikerep',
            'timbulan_sampah_masuk_kg' => 270440.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Lakar Santri',
            'kode_fasilitas' => '54',
            'alamat' => 'Jl. Lakarsantri',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Lakarsantri',
            'timbulan_sampah_masuk_kg' => 84570.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Wisma Lidah Kulon',
            'kode_fasilitas' => '55',
            'alamat' => 'Jl. Perum Lidah Kulon',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Lidah Kulon',
            'timbulan_sampah_masuk_kg' => 34030.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Puri Lidah Kulon',
            'kode_fasilitas' => '56',
            'alamat' => 'Jl. Puri Lidah Kulon',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Lidah Kulon',
            'timbulan_sampah_masuk_kg' => 87630.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'UNESA',
            'kode_fasilitas' => '57',
            'alamat' => 'Jl. Lidah',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Lidah Wetan',
            'timbulan_sampah_masuk_kg' => 10360.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bangkingan Aspol',
            'kode_fasilitas' => '58',
            'alamat' => 'Jl. Bangkingan',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Bangkingan',
            'timbulan_sampah_masuk_kg' => 7340.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bangkingan',
            'kode_fasilitas' => '59',
            'alamat' => 'Jl. Bangkingan',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Sumur Welut',
            'timbulan_sampah_masuk_kg' => 85450.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sukomanunggal',
            'kode_fasilitas' => '60',
            'alamat' => 'Jl. Suko Manunggal',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Sukomanunggal',
            'timbulan_sampah_masuk_kg' => 185960.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Simohilir',
            'kode_fasilitas' => '61',
            'alamat' => 'Jl. Simo Hilir',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Simo Mulyo',
            'timbulan_sampah_masuk_kg' => 147560.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Simorukun',
            'kode_fasilitas' => '62',
            'alamat' => 'Jl. Simo Mulyo',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Simo Mulyo',
            'timbulan_sampah_masuk_kg' => 544940.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Putat Gede',
            'kode_fasilitas' => '63',
            'alamat' => 'Jl. Darmo Permai Timur',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Putat Gede',
            'timbulan_sampah_masuk_kg' => 364350.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sonokwijenan',
            'kode_fasilitas' => '64',
            'alamat' => 'Jl. Darmo Permai Indah II',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Sono Kewijenan',
            'timbulan_sampah_masuk_kg' => 39250.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Asemrowo',
            'kode_fasilitas' => '65',
            'alamat' => 'Jl. Asem Rowo',
            'kecamatan' => 'Kec. Asemrowo',
            'kelurahan' => 'Kel. Asem Rowo',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jayamix',
            'kode_fasilitas' => '66',
            'alamat' => 'Jl. Tanjungsari',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Sono Kewijenan',
            'timbulan_sampah_masuk_kg' => 305040.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Genting',
            'kode_fasilitas' => '67',
            'alamat' => 'Jl. Genting / Jl. Dupak Rukun',
            'kecamatan' => 'Kec. Asemrowo',
            'kelurahan' => 'Kel. Genting Kalianak',
            'timbulan_sampah_masuk_kg' => 68580.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jl.Greges',
            'kode_fasilitas' => '68',
            'alamat' => 'Jl. Kalianak 51',
            'kecamatan' => 'Kec. Asemrowo',
            'kelurahan' => 'Kel. Tambak Sarioso',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bintang Diponggo',
            'kode_fasilitas' => '69',
            'alamat' => 'Jl. Bintang Diponggo',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Pakis',
            'timbulan_sampah_masuk_kg' => 311390.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Dupak Bandarejo',
            'kode_fasilitas' => '70',
            'alamat' => 'Jl. Dupak Bandarejo I',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Dupak',
            'timbulan_sampah_masuk_kg' => 93450.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Dupak Bangunsari',
            'kode_fasilitas' => '71',
            'alamat' => 'Jl. Alun-alun Bangun Sari',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Dupak',
            'timbulan_sampah_masuk_kg' => 240010.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Mbah Ratu',
            'kode_fasilitas' => '72',
            'alamat' => 'Jl. Gresik',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Morokrembangan',
            'timbulan_sampah_masuk_kg' => 286810.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Asrama Brimob PPI',
            'kode_fasilitas' => '73',
            'alamat' => 'Jl. Gresik',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Morokrembangan',
            'timbulan_sampah_masuk_kg' => 17940.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tambak Asri',
            'kode_fasilitas' => '74',
            'alamat' => 'Bawah Tol Dupak',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Krembangan',
            'timbulan_sampah_masuk_kg' => 285260.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tanjung Sadari',
            'kode_fasilitas' => '75',
            'alamat' => 'Jl. Tanjung Sadari',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Perak Barat',
            'timbulan_sampah_masuk_kg' => 168910.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Krembangan Barat',
            'kode_fasilitas' => '76',
            'alamat' => 'Jl. Krembangan Barat',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Krembangan Selatan',
            'timbulan_sampah_masuk_kg' => 329230.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Morokrembangan',
            'kode_fasilitas' => '77',
            'alamat' => 'Bozem morokrembangan',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Morokrembangan',
            'timbulan_sampah_masuk_kg' => 27800.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Wonokusumo Kidul',
            'kode_fasilitas' => '78',
            'alamat' => 'Jl. Wonokusumo Kidul',
            'kecamatan' => 'Kec. Semampir',
            'kelurahan' => 'Kel. Pegirian',
            'timbulan_sampah_masuk_kg' => 468620.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jl.Pegirian',
            'kode_fasilitas' => '79',
            'alamat' => 'Jl.pegirian',
            'kecamatan' => 'Kec. Semampir',
            'kelurahan' => 'Kel. Sidotopo',
            'timbulan_sampah_masuk_kg' => 71430.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Benteng',
            'kode_fasilitas' => '80',
            'alamat' => 'Jl. Benteng',
            'kecamatan' => 'Kec. Pabean Cantian',
            'kelurahan' => 'Kel. Perak Utara',
            'timbulan_sampah_masuk_kg' => 742890.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kertopaten',
            'kode_fasilitas' => '81',
            'alamat' => 'Jl. Kertopaten',
            'kecamatan' => 'Kec. Pabean Cantian',
            'kelurahan' => 'Kel. Nyamplungan',
            'timbulan_sampah_masuk_kg' => 487310.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'THP Kenjeran',
            'kode_fasilitas' => '82',
            'alamat' => 'Jl. Kenjeran',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Kenjeran',
            'timbulan_sampah_masuk_kg' => 65730.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jati Srono',
            'kode_fasilitas' => '83',
            'alamat' => 'Jl. Jati Purwo ( Jati Srono )',
            'kecamatan' => 'Kec. Semampir',
            'kelurahan' => 'Kel. Ujung',
            'timbulan_sampah_masuk_kg' => 86310.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jati Purwo',
            'kode_fasilitas' => '84',
            'alamat' => 'Jl. Jati purwo',
            'kecamatan' => 'Kec. Semampir',
            'kelurahan' => 'Kel. Ujung',
            'timbulan_sampah_masuk_kg' => 88660.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Mrutu Kalianyar II',
            'kode_fasilitas' => '85',
            'alamat' => 'Jl. Mrutu Kalianyar',
            'kecamatan' => 'Kec. Semampir',
            'kelurahan' => 'Kel. Wonokusumo',
            'timbulan_sampah_masuk_kg' => 155060.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pesapen Pompa',
            'kode_fasilitas' => '86',
            'alamat' => 'Jl. Pesapen Kali',
            'kecamatan' => 'Kec. Pabean Cantian',
            'kelurahan' => 'Kel. Krembangan Utara',
            'timbulan_sampah_masuk_kg' => 29510.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Babaan',
            'kode_fasilitas' => '87',
            'alamat' => 'Jl. Kebalen Timur',
            'kecamatan' => 'Kec. Pabean Cantian',
            'kelurahan' => 'Kel. Krembangan Utara',
            'timbulan_sampah_masuk_kg' => 137460.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Indrapura PLN',
            'kode_fasilitas' => '88',
            'alamat' => 'Jl. Indrapura PLN',
            'kecamatan' => 'Kec. Pabean Cantian',
            'kelurahan' => 'Kel. Perak Timur',
            'timbulan_sampah_masuk_kg' => 152430.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jl.Semut Kali',
            'kode_fasilitas' => '89',
            'alamat' => 'Jl. Semut kali',
            'kecamatan' => 'Kec. Pabean Cantian',
            'kelurahan' => 'Kel. Bongkaran',
            'timbulan_sampah_masuk_kg' => 87180.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tambak Deres',
            'kode_fasilitas' => '90',
            'alamat' => 'Jl. Tambak Deres',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Bulak',
            'timbulan_sampah_masuk_kg' => 312260.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Memet',
            'kode_fasilitas' => '91',
            'alamat' => 'Jl. Memet Sastro Wirya',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Komplek Kenjeran',
            'timbulan_sampah_masuk_kg' => 71130.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Platuk Donomulyo',
            'kode_fasilitas' => '92',
            'alamat' => 'jl. DK Bulak Banteng',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Sidotopo Wetan',
            'timbulan_sampah_masuk_kg' => 408040.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sidotopo Wetan',
            'kode_fasilitas' => '93',
            'alamat' => 'Jl. Sidotopo Wetan Indah I',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Sidotopo Wetan',
            'timbulan_sampah_masuk_kg' => 355600.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Podomoro',
            'kode_fasilitas' => '94',
            'alamat' => 'Jl. Bulak banteng Sekolahan',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Sidotopo Wetan',
            'timbulan_sampah_masuk_kg' => 205790.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bulak Banteng Bandarejo',
            'kode_fasilitas' => '95',
            'alamat' => 'Jl. Bandarejo Bulak Banteng',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Bulak Banteng',
            'timbulan_sampah_masuk_kg' => 19070.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bulak Banteng Timur',
            'kode_fasilitas' => '96',
            'alamat' => 'Jl. Bulak Banteng Timur',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Bulak Banteng',
            'timbulan_sampah_masuk_kg' => 142390.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bulak Banteng II',
            'kode_fasilitas' => '97',
            'alamat' => 'Jl. Tenggumung Wetan',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Bulak Banteng',
            'timbulan_sampah_masuk_kg' => 353020.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kali Kedinding',
            'kode_fasilitas' => '98',
            'alamat' => 'Jl. Tanah Kali Kedinding',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Tanah Kali Kedinding',
            'timbulan_sampah_masuk_kg' => 462940.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tambak Wedi',
            'kode_fasilitas' => '99',
            'alamat' => 'Jl. Tambak Wedi',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Tambak Wedi',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Gubeng Masjid',
            'kode_fasilitas' => '100',
            'alamat' => 'Jl. Gubeng Masjid',
            'kecamatan' => 'Kec. Tambak Sari',
            'kelurahan' => 'Kel. Pacar Keling',
            'timbulan_sampah_masuk_kg' => 55270.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Gubeng Masjid',
            'kode_fasilitas' => '101',
            'alamat' => 'Jl. Gubeng Masjid Pasar',
            'kecamatan' => 'Kec. Tambak Sari',
            'kelurahan' => 'Kel. Pacar Keling',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Candi Puro',
            'kode_fasilitas' => '102',
            'alamat' => 'Jl. Pacar Keling III',
            'kecamatan' => 'Kec. Tambak Sari',
            'kelurahan' => 'Kel. Pacar Keling',
            'timbulan_sampah_masuk_kg' => 488000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Pacar Keling',
            'kode_fasilitas' => '103',
            'alamat' => 'Jl. Belahan',
            'kecamatan' => 'Kec. Tambak Sari',
            'kelurahan' => 'Kel. Pacar Keling',
            'timbulan_sampah_masuk_kg' => 133170.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Petojo',
            'kode_fasilitas' => '104',
            'alamat' => 'Jl. Petojo (Belakang RS Husada utama)',
            'kecamatan' => 'Kec. Tambak Sari',
            'kelurahan' => 'Kel. Pacar Keling',
            'timbulan_sampah_masuk_kg' => 73150.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kaliwaron II',
            'kode_fasilitas' => '105',
            'alamat' => 'Jl. Kaliwaron',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Mojo',
            'timbulan_sampah_masuk_kg' => 361760.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Mojoarum',
            'kode_fasilitas' => '106',
            'alamat' => 'Jl. Mojoarum',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Mojo',
            'timbulan_sampah_masuk_kg' => 488010.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Srikana',
            'kode_fasilitas' => '107',
            'alamat' => 'Jl. Srikana',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Airlangga',
            'timbulan_sampah_masuk_kg' => 755860.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kangean',
            'kode_fasilitas' => '108',
            'alamat' => 'Jl. Kangean',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Gubeng',
            'timbulan_sampah_masuk_kg' => 242960.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Pucang',
            'kode_fasilitas' => '109',
            'alamat' => 'Jl. Pasar Pucang Anom',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Gubeng',
            'timbulan_sampah_masuk_kg' => 112590.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kalibokor',
            'kode_fasilitas' => '110',
            'alamat' => 'Jl. Kalibokor',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Pucang Sewu',
            'timbulan_sampah_masuk_kg' => 266410.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bratang',
            'kode_fasilitas' => '111',
            'alamat' => 'Jl. Bratang Binangun',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Barata Jaya',
            'timbulan_sampah_masuk_kg' => 655370.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ngagel Dadi',
            'kode_fasilitas' => '112',
            'alamat' => 'Jl. Ngagel Dadi III',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Ngagel Rejo',
            'timbulan_sampah_masuk_kg' => 344490.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bratang Lapangan',
            'kode_fasilitas' => '113',
            'alamat' => 'Jl. Bratang Lapangan',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Baratajaya',
            'timbulan_sampah_masuk_kg' => 191320.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Barata Jaya',
            'kode_fasilitas' => '114',
            'alamat' => 'Jl. Barata Jaya XXVII',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Kertajaya',
            'timbulan_sampah_masuk_kg' => 91050.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Buktong',
            'kode_fasilitas' => '115',
            'alamat' => 'Jl. Menur - Manyar',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Menur Pumpungan',
            'timbulan_sampah_masuk_kg' => 426370.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'ITS',
            'kode_fasilitas' => '116',
            'alamat' => 'Jl. Arif Rahman Hakim',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Keputih',
            'timbulan_sampah_masuk_kg' => 318940.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'IPLT Keputih',
            'kode_fasilitas' => '117',
            'alamat' => 'Jl. Keputih Tegal',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Keputih',
            'timbulan_sampah_masuk_kg' => 344260.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Gebang Keputih',
            'kode_fasilitas' => '118',
            'alamat' => 'Jl. Gebang Putih',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Gebang Putih',
            'timbulan_sampah_masuk_kg' => 242100.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Klampis',
            'kode_fasilitas' => '119',
            'alamat' => 'Jl. Klampis Ngasem',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Klampis Ngasem',
            'timbulan_sampah_masuk_kg' => 215830.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Semolowaru',
            'kode_fasilitas' => '120',
            'alamat' => 'Jl. Semolowaru',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Semolowaru',
            'timbulan_sampah_masuk_kg' => 340820.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Semolowaru Bahari',
            'kode_fasilitas' => '121',
            'alamat' => 'Jl. Medokan Semampir (Pertigaan TPU Keputih)',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Medokan Semampir',
            'timbulan_sampah_masuk_kg' => 121910.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Medokan Semampir',
            'kode_fasilitas' => '122',
            'alamat' => 'Jl. Medokan Semampir',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Medokan Semampir',
            'timbulan_sampah_masuk_kg' => 233610.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Asrama Brimob Nginden',
            'kode_fasilitas' => '123',
            'alamat' => 'Jl. Nginden Intan Barat',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Nginden Jangkungan',
            'timbulan_sampah_masuk_kg' => 3030.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kejawen Putih',
            'kode_fasilitas' => '124',
            'alamat' => 'Jl. Kejawan Putih Tambak',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Kejawan Putih Tambak',
            'timbulan_sampah_masuk_kg' => 269790.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Rungkut Alang alang',
            'kode_fasilitas' => '125',
            'alamat' => 'Jl. Kali Rungkut',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Kalirungkut',
            'timbulan_sampah_masuk_kg' => 424600.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Rungkut Kidul II',
            'kode_fasilitas' => '126',
            'alamat' => 'Jl. Pasar Rungkut Kidul Pasar Pahing',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Rungkut Kidul',
            'timbulan_sampah_masuk_kg' => 472030.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kendal Sari',
            'kode_fasilitas' => '127',
            'alamat' => 'Jl. Kendalsari ( Barat Kebun Bibit )',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Penjaringansari',
            'timbulan_sampah_masuk_kg' => 280060.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Penjaringan Sari',
            'kode_fasilitas' => '128',
            'alamat' => 'Jl. Pandugo',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Penjaringansari',
            'timbulan_sampah_masuk_kg' => 457260.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Medokan Ayu II',
            'kode_fasilitas' => '129',
            'alamat' => 'Jl. Raya Medokan Ayu / Perum.Kosagra',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Medokan Ayu',
            'timbulan_sampah_masuk_kg' => 475340.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Wonorejo',
            'kode_fasilitas' => '130',
            'alamat' => 'Jl. Raya Wonorejo',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Wonorejo',
            'timbulan_sampah_masuk_kg' => 149550.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Rungkut Asri',
            'kode_fasilitas' => '131',
            'alamat' => 'Jl. Rungkut asri',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Rungkut Kidul',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Rungkut Menanggal',
            'kode_fasilitas' => '132',
            'alamat' => 'Jl. Rungkut Menanggal Harapan',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Rungkut Menanggal',
            'timbulan_sampah_masuk_kg' => 331510.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Metro',
            'kode_fasilitas' => '133',
            'alamat' => 'Jl. Sukarno hatta (pojok Merr gunung Anyar)',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Rungkut Menanggal',
            'timbulan_sampah_masuk_kg' => 170100.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Wiguna Timur',
            'kode_fasilitas' => '134',
            'alamat' => 'Jl. Wiguna Timur',
            'kecamatan' => 'Kec. Gunung Anyar',
            'kelurahan' => 'Kel. Gunung Anyar Tambak',
            'timbulan_sampah_masuk_kg' => 183270.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bogen Tambaksari',
            'kode_fasilitas' => '135',
            'alamat' => 'Jl. Bogen',
            'kecamatan' => 'Kec. Tambak Sari',
            'kelurahan' => 'Kel. Ploso',
            'timbulan_sampah_masuk_kg' => 432810.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Purimas',
            'kode_fasilitas' => '136',
            'alamat' => 'Jl. Perum Purimas Gunung anyar',
            'kecamatan' => 'Kec. Gunung Anyar',
            'kelurahan' => 'Kel. Gunung Anyar',
            'timbulan_sampah_masuk_kg' => 144990.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tenggilis Mejoyo',
            'kode_fasilitas' => '137',
            'alamat' => 'Jl. Tenggilis Mejoyo',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Tenggilis Mejoyo',
            'timbulan_sampah_masuk_kg' => 152950.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Tenggilis Utara',
            'kode_fasilitas' => '138',
            'alamat' => 'Jl. Tenggilis Utara',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Tenggilis Utara',
            'timbulan_sampah_masuk_kg' => 402500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kendangsari',
            'kode_fasilitas' => '139',
            'alamat' => 'Jl. Raya Kendangsari',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Kendangsari',
            'timbulan_sampah_masuk_kg' => 567260.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kutisari PLN II',
            'kode_fasilitas' => '140',
            'alamat' => 'Jl. Kutisari Indah',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Kutisari',
            'timbulan_sampah_masuk_kg' => 251260.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Siwalankerto Landasan',
            'kode_fasilitas' => '141',
            'alamat' => 'Jl. Siwalan Kerto',
            'kecamatan' => 'Kec. Wonocolo',
            'kelurahan' => 'Kel. Siwalankerto',
            'timbulan_sampah_masuk_kg' => 393110.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jemur Wonosari',
            'kode_fasilitas' => '142',
            'alamat' => 'Jl. Jemur Wonosari',
            'kecamatan' => 'Kec. Wonocolo',
            'kelurahan' => 'Kel. Jemur Wonosari',
            'timbulan_sampah_masuk_kg' => 472320.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Wisma Permai II',
            'kode_fasilitas' => '143',
            'alamat' => 'Jl. Wisma Permai III',
            'kecamatan' => 'Kec. Mulyorejo',
            'kelurahan' => 'Kel. Kalisari',
            'timbulan_sampah_masuk_kg' => 104420.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Sutorejo',
            'kode_fasilitas' => '144',
            'alamat' => 'Jl. Sutorejo',
            'kecamatan' => 'Kec. Mulyorejo',
            'kelurahan' => 'Kel. Dukuh Sutorejo',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kalijudan',
            'kode_fasilitas' => '145',
            'alamat' => 'Jl. Kalijudan',
            'kecamatan' => 'Kec. Mulyorejo',
            'kelurahan' => 'Kel. Kalijudan',
            'timbulan_sampah_masuk_kg' => 229590.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bukit Barisan',
            'kode_fasilitas' => '146',
            'alamat' => 'Jl. Bukit Barisan',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Petemon',
            'timbulan_sampah_masuk_kg' => 473040.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Petemon Kuburan',
            'kode_fasilitas' => '147',
            'alamat' => 'Jl. Petemon Kuburan',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Sawahan',
            'timbulan_sampah_masuk_kg' => 66280.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kembang Kuning',
            'kode_fasilitas' => '148',
            'alamat' => 'Jl. Kembang Kuning',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Darmo',
            'timbulan_sampah_masuk_kg' => 661730.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Simo Katrungan',
            'kode_fasilitas' => '149',
            'alamat' => 'Jl. Simo Katrungan',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Banyu Urip',
            'timbulan_sampah_masuk_kg' => 79890.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Mataram utara',
            'kode_fasilitas' => '150',
            'alamat' => 'Jl. Makam Putat Jaya',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Putat Jaya',
            'timbulan_sampah_masuk_kg' => 694430.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Makam Mataram II',
            'kode_fasilitas' => '151',
            'alamat' => 'Jl. Putat Jaya',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Putat Jaya',
            'timbulan_sampah_masuk_kg' => 597410.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Joyoboyo',
            'kode_fasilitas' => '152',
            'alamat' => 'Jl. Joyoboyo Gunungsari',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Sawunggaling',
            'timbulan_sampah_masuk_kg' => 378230.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Wonoboyo',
            'kode_fasilitas' => '153',
            'alamat' => 'Jl. Wonoboyo',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Sawunggaling',
            'timbulan_sampah_masuk_kg' => 42440.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bukit Mas',
            'kode_fasilitas' => '154',
            'alamat' => 'Jl. Puncak Bukit Mas - Dukuh pakis',
            'kecamatan' => 'Kec. Dukuh Pakis',
            'kelurahan' => 'Kel. Dukuh Pakis',
            'timbulan_sampah_masuk_kg' => 27800.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pradah Kali Kendal',
            'kode_fasilitas' => '155',
            'alamat' => 'Jl. Prada makam',
            'kecamatan' => 'Kec. Dukuh Pakis',
            'kelurahan' => 'Kel. Pradah Kali Kendal',
            'timbulan_sampah_masuk_kg' => 110670.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jl.Jetis Kulon',
            'kode_fasilitas' => '156',
            'alamat' => 'Jl. Jetis Kulon',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Wonokromo',
            'timbulan_sampah_masuk_kg' => 543720.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ngagel',
            'kode_fasilitas' => '157',
            'alamat' => 'Jl. Ngagel',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Ngagel',
            'timbulan_sampah_masuk_kg' => 127310.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Beras Bendul Merisi II',
            'kode_fasilitas' => '158',
            'alamat' => 'Jl. Bendul Merisi',
            'kecamatan' => 'Kec. Wonocolo',
            'kelurahan' => 'Kel. Bendul Merisi',
            'timbulan_sampah_masuk_kg' => 246110.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jagir',
            'kode_fasilitas' => '159',
            'alamat' => 'Jl. Jagir',
            'kecamatan' => 'Kec. Wonokromo',
            'kelurahan' => 'Kel. Jagir',
            'timbulan_sampah_masuk_kg' => 72310.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bosem Morokrembangan',
            'kode_fasilitas' => '160',
            'alamat' => 'Jl. Prapen',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Kendangsari',
            'timbulan_sampah_masuk_kg' => 11100.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bendul Merisi',
            'kode_fasilitas' => '161',
            'alamat' => 'Jl. Bendul Merisi Selatan',
            'kecamatan' => 'Kec. Wonocolo',
            'kelurahan' => 'Kel. Bendul Merisi',
            'timbulan_sampah_masuk_kg' => 247540.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Prapen DKK',
            'kode_fasilitas' => '162',
            'alamat' => 'Jl. Jemur Sari DKK',
            'kecamatan' => 'Kec. Wonocolo',
            'kelurahan' => 'Kel. Sidosermo',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.kedurus',
            'kode_fasilitas' => '163',
            'alamat' => 'Jl. Gunung sari indah (pasar kedurus)',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Kedurus',
            'timbulan_sampah_masuk_kg' => 159800.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kemlaten',
            'kode_fasilitas' => '164',
            'alamat' => 'Jl. Mastrip',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Kedurus',
            'timbulan_sampah_masuk_kg' => 55100.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Bogangin',
            'kode_fasilitas' => '165',
            'alamat' => 'Jl. Mastrip',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Kedurus',
            'timbulan_sampah_masuk_kg' => 125910.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kebraon II',
            'kode_fasilitas' => '166',
            'alamat' => 'Jl. Mastrip',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Kebraon',
            'timbulan_sampah_masuk_kg' => 276970.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Rusun Waru gunung',
            'kode_fasilitas' => '167',
            'alamat' => 'Jl. Mastrip Rusunawa Warugunung',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Waru Gunung',
            'timbulan_sampah_masuk_kg' => 36020.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ketintang Baru Selatan',
            'kode_fasilitas' => '168',
            'alamat' => 'Jl. Ketintang Seraten',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Ketintang',
            'timbulan_sampah_masuk_kg' => 387200.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Gayung Sari',
            'kode_fasilitas' => '169',
            'alamat' => 'Jl. Gayungsari 4',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Gayungan',
            'timbulan_sampah_masuk_kg' => 145970.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Gayung Pring',
            'kode_fasilitas' => '170',
            'alamat' => 'Jl. Gayungsari 1',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Menanggal',
            'timbulan_sampah_masuk_kg' => 171440.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Gayung Kebonsari',
            'kode_fasilitas' => '171',
            'alamat' => 'Jl. Gayung Kebonsari 8 / Mayangkara',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Kebonsari',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Menanggal',
            'kode_fasilitas' => '172',
            'alamat' => 'Jl. Perum Menanggal',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Dukuh Menanggal',
            'timbulan_sampah_masuk_kg' => 300640.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Dukuh Menanggal',
            'kode_fasilitas' => '173',
            'alamat' => 'Jl. Dukuh Menanggal Barat',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Dukuh Menanggal',
            'timbulan_sampah_masuk_kg' => 145730.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kalianak',
            'kode_fasilitas' => '174',
            'alamat' => 'Jl. Kalianak 51',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Dukuh Menanggal',
            'timbulan_sampah_masuk_kg' => 19450.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Karah',
            'kode_fasilitas' => '175',
            'alamat' => 'Jl. Karah',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Karah',
            'timbulan_sampah_masuk_kg' => 173610.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Prapen',
            'kode_fasilitas' => '176',
            'alamat' => 'Jl. Raya Prapen',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Kendangsari',
            'timbulan_sampah_masuk_kg' => 156080.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jambangan',
            'kode_fasilitas' => '177',
            'alamat' => 'Jl. Jambangan',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Jambangan',
            'timbulan_sampah_masuk_kg' => 183870.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pagesangan',
            'kode_fasilitas' => '178',
            'alamat' => 'Jl. Pagesangan',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Pagesangan',
            'timbulan_sampah_masuk_kg' => 418660.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Kebonsari Makam',
            'kode_fasilitas' => '179',
            'alamat' => 'Jl. Kebonsari Manunggal',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Kebonsari',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Ps.Wiyung',
            'kode_fasilitas' => '180',
            'alamat' => 'Jl. Wiyung',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Wiyung',
            'timbulan_sampah_masuk_kg' => 258380.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Babatan Pratama',
            'kode_fasilitas' => '181',
            'alamat' => 'Jl. Babatan Indah',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Babatan',
            'timbulan_sampah_masuk_kg' => 135070.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pondok Indah Wiyung',
            'kode_fasilitas' => '182',
            'alamat' => 'Jl. Perum Bumi Tamara',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Jajar Tunggal',
            'timbulan_sampah_masuk_kg' => 36010.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'TPI Wiyung',
            'kode_fasilitas' => '183',
            'alamat' => 'Jl. Perum Bumi Tamara',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Jajar Tunggal',
            'timbulan_sampah_masuk_kg' => 33080.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jajar Tunggal II',
            'kode_fasilitas' => '184',
            'alamat' => 'Jl. Mastrip',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Jajar Tunggal',
            'timbulan_sampah_masuk_kg' => 113410.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Pondok Manggala',
            'kode_fasilitas' => '185',
            'alamat' => 'Jl. Perum Mastrip',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Balas Klumprik',
            'timbulan_sampah_masuk_kg' => 12670.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Balas Klumprik',
            'kode_fasilitas' => '186',
            'alamat' => 'Jl. Koterm Balas Klumprik',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Balas Klumprik',
            'timbulan_sampah_masuk_kg' => 156060.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Karang Pilang II',
            'kode_fasilitas' => '187',
            'alamat' => 'Jl. Bumi Marinir',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Karang Pilang',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jeruk',
            'kode_fasilitas' => '188',
            'alamat' => 'Jl. Jeruk',
            'kecamatan' => 'Kec. Lakarsantri',
            'kelurahan' => 'Kel. Jeruk',
            'timbulan_sampah_masuk_kg' => 5230.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Yani Golf',
            'kode_fasilitas' => '189',
            'alamat' => 'Jl. Golf V',
            'kecamatan' => 'Kec. Dukuh Pakis',
            'kelurahan' => 'Kel. Gunung Sari',
            'timbulan_sampah_masuk_kg' => 31530.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Tempat Penampungan Sementara',
            'nama_fasilitas' => 'Jogoloyo',
            'kode_fasilitas' => '190',
            'alamat' => 'Jl. Jogoloyo',
            'kecamatan' => 'Kec. Dukuh Pakis',
            'kelurahan' => 'Kel. Gunung Sari',
            'timbulan_sampah_masuk_kg' => 85670.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Menur',
            'kode_fasilitas' => '193',
            'alamat' => 'Jl. Menur 31',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Mojo',
            'timbulan_sampah_masuk_kg' => 102500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Keputran',
            'kode_fasilitas' => '194',
            'alamat' => 'Jl. Keputran utara',
            'kecamatan' => 'Kec. Tegalsari',
            'kelurahan' => 'Kel. Keputran',
            'timbulan_sampah_masuk_kg' => 179250.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Bratang',
            'kode_fasilitas' => '195',
            'alamat' => 'Jl. Manyar',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Baratajaya',
            'timbulan_sampah_masuk_kg' => 142000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Kayoon',
            'kode_fasilitas' => '196',
            'alamat' => 'Jl. Kayoon',
            'kecamatan' => 'Kec. Genteng',
            'kelurahan' => 'Kel. Embong Kaliasin',
            'timbulan_sampah_masuk_kg' => 36250.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Liponsos Keputih 2',
            'kode_fasilitas' => '197',
            'alamat' => 'Jl. Keputih Tegal',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Keputih',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Wonorejo I',
            'kode_fasilitas' => '198',
            'alamat' => 'Jl. Kendalsari ( Barat Kebun Bibit )',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Wonorejo (Rungkut)',
            'timbulan_sampah_masuk_kg' => 750.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Rungkut Asri',
            'kode_fasilitas' => '199',
            'alamat' => 'Jl. Rungkut asri',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Rungkut Kidul',
            'timbulan_sampah_masuk_kg' => 96500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Tenggilis Utara',
            'kode_fasilitas' => '200',
            'alamat' => 'Jl. Tenggilis Utara',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Tenggilis Utara',
            'timbulan_sampah_masuk_kg' => 63000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Tenggilis',
            'kode_fasilitas' => '201',
            'alamat' => 'Jl. Tenggilis Tengah',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Kendangsari',
            'timbulan_sampah_masuk_kg' => 119000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Gayungsari',
            'kode_fasilitas' => '202',
            'alamat' => 'Jl. Gayungsari',
            'kecamatan' => 'Kec. Gayungan',
            'kelurahan' => 'Kel. Gayungan',
            'timbulan_sampah_masuk_kg' => 37100.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Bibis Karah',
            'kode_fasilitas' => '203',
            'alamat' => 'jl. Bibis Karah',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Karah',
            'timbulan_sampah_masuk_kg' => 29000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Jambangan',
            'kode_fasilitas' => '204',
            'alamat' => 'Jl. Jambangan',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Jambangan',
            'timbulan_sampah_masuk_kg' => 162750.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Balas Klumprik',
            'kode_fasilitas' => '205',
            'alamat' => 'Jl. Koterm Balas Klumprik',
            'kecamatan' => 'Kec. Wiyung',
            'kelurahan' => 'Kel. Balas Klumprik',
            'timbulan_sampah_masuk_kg' => 32750.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Gunungsari',
            'kode_fasilitas' => '206',
            'alamat' => 'Jl. Gunungsari',
            'kecamatan' => 'Kec. Dukuh Pakis',
            'kelurahan' => 'Kel. Gunungsari',
            'timbulan_sampah_masuk_kg' => 38500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Putat Jaya',
            'kode_fasilitas' => '207',
            'alamat' => 'Jl. Putat Jaya',
            'kecamatan' => 'Kec. Sawahan',
            'kelurahan' => 'Kel. Putat Jaya',
            'timbulan_sampah_masuk_kg' => 19000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Sonokwijenan',
            'kode_fasilitas' => '208',
            'alamat' => 'Jl. Darmo Permai Indah II',
            'kecamatan' => 'Kec. Sukomanunggal',
            'kelurahan' => 'Kel. Sono Kewijenan',
            'timbulan_sampah_masuk_kg' => 77500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Tubanan',
            'kode_fasilitas' => '209',
            'alamat' => 'Jl. Simpang Darmo Permai',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Karangpoh',
            'timbulan_sampah_masuk_kg' => 13250.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Rungkut Merr',
            'kode_fasilitas' => '210',
            'alamat' => 'Jl. Sukarno hatta (pojok Merr gunung Anyar)',
            'kecamatan' => 'Kec. Gunung Anyar',
            'kelurahan' => 'Kel. Rungkut Menanggal',
            'timbulan_sampah_masuk_kg' => 114500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Iplc Keputih',
            'kode_fasilitas' => '211',
            'alamat' => 'Jl. Keputih Tegal',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Keputih',
            'timbulan_sampah_masuk_kg' => 47500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Babat Jerawat',
            'kode_fasilitas' => '212',
            'alamat' => 'Jl. Babat Jerawat',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Babat Jerawat',
            'timbulan_sampah_masuk_kg' => 39500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Medokan Ayu',
            'kode_fasilitas' => '213',
            'alamat' => 'jl. Medokan ayu',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Medokan Ayu',
            'timbulan_sampah_masuk_kg' => 63500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Jangkar',
            'kode_fasilitas' => '214',
            'alamat' => 'jl. Bibis Karah',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Karah',
            'timbulan_sampah_masuk_kg' => 55000.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Kyai Tambak Deres',
            'kode_fasilitas' => '215',
            'alamat' => 'Jl. Tambak Deres',
            'kecamatan' => 'kec. Bulak',
            'kelurahan' => 'Kel. Bulak',
            'timbulan_sampah_masuk_kg' => 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Wonorejo Ii',
            'kode_fasilitas' => '216',
            'alamat' => 'Jl. Kendalsari ( Barat Kebun Bibit )',
            'kecamatan' => 'Kec. Rungkut',
            'kelurahan' => 'Kel. Wonorejo (Rungkut)',
            'timbulan_sampah_masuk_kg' => 586750.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Tambak Wedi',
            'kode_fasilitas' => '217',
            'alamat' => 'Jl. Tambak Wedi',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Tambak Wedi',
            'timbulan_sampah_masuk_kg' => 57500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Mbah Ratu',
            'kode_fasilitas' => '218',
            'alamat' => 'Jl. Gresik',
            'kecamatan' => 'Kec. Krembangan',
            'kelurahan' => 'Kel. Morokrembangan',
            'timbulan_sampah_masuk_kg' => 28500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'Rumah Kompos',
            'nama_fasilitas' => 'Rumah Kompos Nginden Jangkungan',
            'kode_fasilitas' => '219',
            'alamat' => 'Jl. Nginden Jangkungan',
            'kecamatan' => 'Kec. Sukolilo',
            'kelurahan' => 'Kel. Nginden Jangkungan',
            'timbulan_sampah_masuk_kg' => 43750.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'Super Depo Sutorejo',
            'kode_fasilitas' => '220',
            'alamat' => 'Jl. Sutorejo',
            'kecamatan' => 'Kec. Mulyorejo',
            'kelurahan' => 'Kel. Dukuh Sutorejo',
            'timbulan_sampah_masuk_kg' => 287561.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'PDU Jambangan',
            'kode_fasilitas' => '221',
            'alamat' => 'Jl. Jambangan Kebonagung',
            'kecamatan' => 'Kec. Jambangan',
            'kelurahan' => 'Kel. Jambangan',
            'timbulan_sampah_masuk_kg' => 194920.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Tambak Osowilangun',
            'kode_fasilitas' => '222',
            'alamat' => 'Jl. Tambak Osowilangun',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Tambak Oso Wilangon',
            'timbulan_sampah_masuk_kg' => 242162.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Tenggilis',
            'kode_fasilitas' => '223',
            'alamat' => 'Jl. Tenggilis Tengah',
            'kecamatan' => 'Kec. Tenggilis Mejoyo',
            'kelurahan' => 'Kel. Kendangsari',
            'timbulan_sampah_masuk_kg' => 168790.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Kedung Cowek',
            'kode_fasilitas' => '224',
            'alamat' => 'Kedung Cowek, Bulak',
            'kecamatan' => 'Kec. Bulak',
            'kelurahan' => 'Kel. Kedung cowek',
            'timbulan_sampah_masuk_kg' => 131710.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Gunung Anyar',
            'kode_fasilitas' => '225',
            'alamat' => 'Gunung Anyar Tambak, Gunung Anyar',
            'kecamatan' => 'Kec. Gunung Anyar',
            'kelurahan' => 'Kel. Gunung Anyar Tambak',
            'timbulan_sampah_masuk_kg' => 155890.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Karang Pilang',
            'kode_fasilitas' => '226',
            'alamat' => 'Warugunung, Karang Pilang',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Waru Gunung',
            'timbulan_sampah_masuk_kg' => 110850.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Warugunung',
            'kode_fasilitas' => '227',
            'alamat' => 'Warugunung, Karang Pilang',
            'kecamatan' => 'Kec. Karangpilang',
            'kelurahan' => 'Kel. Waru Gunung',
            'timbulan_sampah_masuk_kg' => 161790.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Banjarsugihan',
            'kode_fasilitas' => '228',
            'alamat' => 'Jl. Banjarsugihan Gang Rolax',
            'kecamatan' => 'Kec. Tandes',
            'kelurahan' => 'Kel. Banjar Sugihan',
            'timbulan_sampah_masuk_kg' => 178455.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'Pemilahan Bratang',
            'kode_fasilitas' => '229',
            'alamat' => 'Jl. Manyar',
            'kecamatan' => 'Kec. Gubeng',
            'kelurahan' => 'Kel. Baratajaya',
            'timbulan_sampah_masuk_kg' => 53640.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPA',
            'nama_fasilitas' => 'TPA Benowo',
            'kode_fasilitas' => '230',
            'alamat' => 'Jl. Romokalisari - TPA Benowo',
            'kecamatan' => 'Kec. Benowo',
            'kelurahan' => 'Kel. Romokalisari',
            'timbulan_sampah_masuk_kg' => 48165680.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Tambakwedi',
            'kode_fasilitas' => '231',
            'alamat' => 'Jl. Kedung Cowek - Suramadu',
            'kecamatan' => 'Kec. Kenjeran',
            'kelurahan' => 'Kel. Tambak Wedi',
            'timbulan_sampah_masuk_kg' => 295520.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_fasilitas[] = [
            'jenis_fasilitas' => 'TPS3R',
            'nama_fasilitas' => 'TPS 3R Sumberejo',
            'kode_fasilitas' => '232',
            'alamat' => 'Jl. Raya Sumberejo - Pakal',
            'kecamatan' => 'Kec. Pakal',
            'kelurahan' => 'Kel. Sumber Rejo',
            'timbulan_sampah_masuk_kg' => 256790.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKAR WANGI',
            'alamat' => 'JL. GENTING TAMBAK DALAM II/36 RT I RW II',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 423.12,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BRANJANGAN',
            'alamat' => 'RAYA TAMBAK LANGON NO. 25',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 145.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BUYUK MANDIRI',
            'alamat' => 'JL. GREGES TIMUR GG. BUYUK INDAH NO. 50',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 210.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KHARISMA MANDIRI',
            'alamat' => 'JL. GREGES TIMUR GG. 3',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 101.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ASAPAT',
            'alamat' => 'JL. WISMA TENGGER XXI NO. 1B RT 04 RW 06',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 241.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERSERI',
            'alamat' => 'JL. TENGGER RAYA I',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 406.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAHLIA',
            'alamat' => 'TENGGER REJO MULYO GG V',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 213.61,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN',
            'alamat' => 'TENGGER REJO MULYO GG 3',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 380.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KENCUR',
            'alamat' => 'JL. WISMA TENGGER VI NO. 2',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 266.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MATAHARI',
            'alamat' => 'JL. TENGGER RAYA III',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 190.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANDAN WANGI',
            'alamat' => 'JL. KANDANGAN 1 NO. 1',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 467.35,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN SEJAHTERA',
            'alamat' => 'TENGGER REJO MULYO GG IV',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 296.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAKINAH',
            'alamat' => 'JL.WISMA TENGGER 20',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 145.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAKURA',
            'alamat' => 'PERUM BUKIT CITRA DARMO JL. KLAKAH REJO',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 318.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRIKANDI RT 2',
            'alamat' => 'JL. WISMA TENGGER XVII',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 421.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMU KUNCI',
            'alamat' => 'JL. WISMA TENGGER VI RT 02 RW 04',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 420.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH ILAHI',
            'alamat' => 'JL. KALISARI SEKOLAHAN RT 02 RW 02 ROMOKALISARI',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 288.35,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ROMO BERKARYA',
            'alamat' => 'JL. ROMOKALISARI RT 04 RW 01',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 464.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KALINGGA',
            'alamat' => 'JL. KENDUNG 110',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 346.46,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MENTARI',
            'alamat' => 'JL. DREAMING LAND C3-10 RT 02 RW 10',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 331.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI ENAM BERSERI',
            'alamat' => 'UKA VI RT 03 RW 02',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 269.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA',
            'alamat' => 'JL. SEMEMI JAYA GG VI C/61',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 300.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA BERIMAN',
            'alamat' => 'JL. SEMEMI JAYA GG 6 LAPANGAN',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 235.58,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA BERSERI',
            'alamat' => 'JL. SEMEMI JAYA GG 5 B2 / 54',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 368.08,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA CANTIK',
            'alamat' => 'JL. SEMEMI JAYA GG VI B / 65',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 438.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA CERIA',
            'alamat' => 'JL. SEMEMI JAYA GG 6 UTAMA',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 254.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA SAKINAH',
            'alamat' => 'SEMEMI JAYA X NOMER 70',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 388.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMEMI JAYA SEJAHTERA',
            'alamat' => 'JL. SEMEMI JAYA GG 5 B1',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 210.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH JAYA',
            'alamat' => 'JL TAMBAK OSOWILANGUN RT 01 RW 02',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 274.52,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KAUMAN BERSERI',
            'alamat' => 'JL. TAMBAK OSOWILANGUN RT 03 RW 02',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 181.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CITRA SUMBER REJEKI',
            'alamat' => 'JL. WISMA LIDAH KULON BLOK XI NO. 54 A',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 407.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LUMINTU CERIA',
            'alamat' => 'JL. WISMA LIDAH KULON BLOK X4 NO 20 RT 03 RW 04',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 247.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAKURA DELAPAN',
            'alamat' => 'WISMA LIDAH KULON JL. BANGKINGAN VIII XF 58 RT 08 RW 04',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 286.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LESTARI',
            'alamat' => 'JL. JERUK RT 03 RW 02',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 117.74,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI 1',
            'alamat' => 'LAKARSANTRI RT 1 RW 4',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 155.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAROKAH',
            'alamat' => 'WISMA LIDAH KULON BLOK Z NO. 5 RT 5 RW 4',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 358.12,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER REJEKI',
            'alamat' => 'JL. WISMA LIDAH KULON BLOK D RT 3 RW 4',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 258.95,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LIDAH HARAPAN 2',
            'alamat' => 'LIDAH HARAPAN BLOK GG 28 RT 2 RW 1',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 244.48,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LIDAH HARAPAN 3',
            'alamat' => 'LIDAH HARAPAN BLOK V/ 22 RT 3 RW 5',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 245.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PEDULI LINGKUNGAN',
            'alamat' => 'POS SAMPAH LIDAH WETAN RT 02 RW 01',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 171.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MITRA RESIK',
            'alamat' => 'JL. PESAPEN GANG PUCUK MERAH',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 244.36,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MUGI BERKAH',
            'alamat' => 'JL. DUKUH PESAPEN NO 4A',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 252.08,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ADI GUNA 7',
            'alamat' => 'PONDOK BENOWO INDAH RT. 07 RW. 09',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 225.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ADI GUNA 9',
            'alamat' => 'PONDOK BENOWO INDAH RT 9 RW 9',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 116.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'AN-NAHL',
            'alamat' => 'PONDOK BENOWO INDAH BLOK FK-17',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 107.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARTA GUNA 8',
            'alamat' => 'PONDOK BENOWO INDAH RT 8 RW 9',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 243.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH',
            'alamat' => 'JL. PONDOK BENOWO INDAH A IX NO. 17 RT 01 RW 11',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 450.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BJA MAKMUR',
            'alamat' => 'BUKIT JERAWAT ASRI RT 8 RW 3',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 219.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAHLIA',
            'alamat' => 'GRIYA BENOWO INDAH RT 2 RW 13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 145.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAHLIA JAYA',
            'alamat' => 'DK. JERAWAT RT 9 RW 4',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 114.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ERTIGA',
            'alamat' => 'PONDOK BENOWO INDAH A4/28 RT 3 RW 11',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 104.52,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GEMAH RIPAH',
            'alamat' => 'PONDOK BENOWO INDAH RT 1 RW 12',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 103.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GRIYA 6',
            'alamat' => 'GRIYA BENOWO INDAH BLOK T RT 06 RW 13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 120.2,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GRIYA BERSIH 5',
            'alamat' => 'GRIYA BENOWO INDAH RT 5 RW 13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 250.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GRIYA BERSIH MELATI 1',
            'alamat' => 'BABAT JERAWAT RT 3 RW 13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 206.67,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LANCAR JAYA',
            'alamat' => 'PONDOK BENOWO INDAH BLOK CS-18',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 300.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN AGAWE SANTOSO',
            'alamat' => 'JL. BABAT JERAWAT BALAI RT 4 RW 11',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 98.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRI REJEKI',
            'alamat' => 'PONDOK BENOWO INDAH RT 07 RW 07',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 132.04,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER REJEKI',
            'alamat' => 'PONDOK BENOWO INDAH RT 01 RW 09',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 335.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERINGIN BERSERI',
            'alamat' => 'BRINGIN BARU 2 NO 22/ BRINGIN GG V RT 5 RW 1',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 250.73,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANUGERAH',
            'alamat' => 'BUMI SARI PRAJA SELATAN II/19 PKK RT 08 RW V LEMPUNG (BALAI RW)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 115.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LONTAR MANDIRI',
            'alamat' => 'PERUM PONDOK LONTAR INDAH RT 5 RW2',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 119.81,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU JAYA',
            'alamat' => 'BUMI INDAH I NO. 10 RT 06 RW 05',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 144.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU SEJAHTERA',
            'alamat' => 'CANDI LONTAR WETAN RT 2 RW 14',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 190.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PKK RT 11',
            'alamat' => 'LEMPUNG PERDANA 1 /11A',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 300.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SWASEMBADA',
            'alamat' => 'CANDI LONTAR TENGAH IV (POS RT, 04)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 123.22,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKARSARI',
            'alamat' => 'SAMBISARI II A (BALAI RT 1 RW 3 SAMBISARI)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 111.57,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PIN PIN 07',
            'alamat' => 'SAMBI ARUM LOR I (POS RT. 05)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 136.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBI RT 8',
            'alamat' => 'SAMBI ARUM LOR XI/10 (POS RT, 08)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 87.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ASOKA MANDIRI',
            'alamat' => 'SIMO REJOSARI B XIV/7',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 287.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CAHAYA ASA',
            'alamat' => 'JL. SIMO KALANGAN BARU NO. 2 RT 06 RW 06',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 99.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PRIMA',
            'alamat' => 'SIMOREJO 14 NO 9 RT 4 RW 2',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 98.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SIMPONI',
            'alamat' => 'JL SIMORUKUN GANG 2 NO 47',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 106.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SURYA MANDIRI SEJAHTERA',
            'alamat' => 'JL. SIMO GUNUNG BARAT BUNTU 18 A',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 143.27,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARJUNA MANDIRI',
            'alamat' => 'SIMO REJOSARI B/13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 188.12,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARYA MULYA',
            'alamat' => 'SIMO POMAHAN BARU BARAT 4',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 257.42,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WARTUN SEJAHTERA',
            'alamat' => 'SIMO POMAHAN BARU BARAT RAYA',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 300.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH SUKOMANUNGGAL',
            'alamat' => 'SUKOMANUNGGAL V/02',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 183.43,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TANJUNG CERIA',
            'alamat' => 'TANJUNGSARI 4 NO 68',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 172.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TANJUNGSARI BAHAGIA',
            'alamat' => 'TANJUNG SARI GANG 3',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 244.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANGGREK',
            'alamat' => 'BANJAR SUGIHAN RT 1 TANDES',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 215.57,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HIJAU MANDIRI',
            'alamat' => 'MANUKAN LOR IV-E',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 372.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ERMA SEJAHTERA',
            'alamat' => 'MANUKAN LOR IV-i',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 175.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BANGYOS',
            'alamat' => 'MANUKAN YOSO II BLOK 7-A/25',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 244.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BANK INFAQ SAMPAH AL-MUHAJIRIN (BISA)',
            'alamat' => 'MANUKAN MUKTI II BLOK 10-B/12',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 183.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERSIMPATIK',
            'alamat' => 'MANUKAN LOR II-A/01 (POS RT, 01)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 396.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKSIMA',
            'alamat' => 'MANUKAN SARI II BLOK 3F-12',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 293.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANUKAN GUYUB RUKUN',
            'alamat' => 'MANUKAN RUKUN I BLOK 18-C/07 (POS RT, 10)',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 389.79,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MUKTI JAYA',
            'alamat' => 'MANUKAN MUKTI II BLOK 11-B/14',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 288.26,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'REJO BERKAH',
            'alamat' => 'MANUKAN REJO VII',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 303.42,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRI LESTARI',
            'alamat' => 'MANUKAN MUKTI IX BLOK 12-B/13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 139.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMANGGUNGAN',
            'alamat' => 'JL. TEMANGGUNGAN 2/1 RT.03 RW.05',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 104.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUNDIH',
            'alamat' => 'RT 3 RW 9',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 303.97,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU SEJAHTERA',
            'alamat' => 'JL LAMONGAN',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 254.27,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANGGIS',
            'alamat' => 'MARGORUKUN IV',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 439.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MARGODADI',
            'alamat' => 'MARGODADI GG TENGAH',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 301.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PRATAMA UNGGUL',
            'alamat' => 'BABADAN RUKUN VIII/23',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 162.85,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RESIK MANDIRI',
            'alamat' => 'MARGORUKUN V/25 A',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 500.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN JAYA',
            'alamat' => 'MARGORUKUN XI/15',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 271.6,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBERNYAWA',
            'alamat' => 'BABADAN I',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 406.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TANJUNG SEJAHTERA',
            'alamat' => 'SUMBER MULYO V',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 112.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'AL HIKMA',
            'alamat' => 'DUPAK MAGERSARI 42',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 230.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARTO MORO',
            'alamat' => 'JL TUBAN 2',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 100.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB KERTORAHARJO',
            'alamat' => 'DUPAK TIMUR',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 237.41,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KOWANDULLING',
            'alamat' => 'JEPARA VIII',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 366.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER BAROKAH',
            'alamat' => 'DUPAK JAYA 6',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 601.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TULIP',
            'alamat' => 'JL DUPAK BARU GG 1',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 121.48,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ASEM JAJAR RT 05',
            'alamat' => 'ASEMJAJAR VI/09',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 400.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ASEM JAJAR RT 11',
            'alamat' => 'ASEMJAJAR V',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 397.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DE JA PAN',
            'alamat' => 'DEMAK JAYA 8',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 351.16,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKAR',
            'alamat' => 'JL. KALIBUTUH TIMUR 2/15',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 244.12,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKAR 2',
            'alamat' => 'KALIBUTUH TIMUR 2/15 RT 05 - RW 07',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 496.74,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANDAN',
            'alamat' => 'JL. KALIBUTUH TIMUR 2A / 10B',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 231.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEHATI',
            'alamat' => 'ASEM JAYA 3/29',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 400.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS',
            'alamat' => 'TEMBOK DUKUH 28',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 359.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS BERSERI 1',
            'alamat' => 'JL. TEMBOK DUKUH 32H',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 456.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS BERSERI 2',
            'alamat' => 'JL. KRANGGAN 134',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 396.21,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS BERSERI 3',
            'alamat' => 'JL. KRANGGAN NO.166',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 300.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS BERSERI 4',
            'alamat' => 'JL. SEMARANG 41',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 270.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS BERSERI 5',
            'alamat' => 'TEMBOK DUKUH NO 8C',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 391.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMPAS BERSERI 6',
            'alamat' => 'JL. KRANGGAN 126',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 503.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BASAM BUTO',
            'alamat' => 'KETANDAN LOR 5',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 173.96,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GENCAR MANDIRI',
            'alamat' => 'JL GENTENG CANDI REJO / I A',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 209.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN SEJAHTERA',
            'alamat' => 'GENTENG BANDAR GG I',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 211.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'FLAMBOYAN',
            'alamat' => 'JL. NGAGLIK GG IV',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 235.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TUNAS MANDIRI',
            'alamat' => 'KANGINAN DKA',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 370.1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARYA MANDIRI',
            'alamat' => 'POLAK WONOREJO',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 208.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SINAMBUNG MULYO',
            'alamat' => 'LAWANG SEKETENG IV/5',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 202.74,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KAMPUNG PECINAN',
            'alamat' => 'TAMBAK BAYAN 1',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 408.04,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAROKAH JAYA',
            'alamat' => 'SIDOYOSO WETAN 42',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 462.1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GRANTING BERSERI DAN SEJAHTERA',
            'alamat' => 'GRANTING BARU IV/29',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 184.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR BERSERI',
            'alamat' => 'SIMOLAWANG 2 BARAT NO 41',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 418.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRIKANDI',
            'alamat' => 'GRANTING BARAT',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 147.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'IKHLAS JAYA',
            'alamat' => 'KEBONDALEM VII/54A',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 400.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BANGKIT SEJAHTERA',
            'alamat' => 'JL. TAMBAK JATI',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 181.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GARUDA',
            'alamat' => 'KAPASARI PEDUKUHAN',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 266.6,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEGARAN BERKAH',
            'alamat' => 'TAMBAK SEGARAN IV',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 355.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEGARAN MAKMUR',
            'alamat' => 'JL. TAMBAK SEGARAN III',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 405.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEGARAN SEJAHTERA',
            'alamat' => 'RT 6 RW 3',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 355.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TAMAR BERSERI',
            'alamat' => 'TAMBAK ARUM JAYA 3/2',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 217.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BOUGENVILLE',
            'alamat' => 'JL. KUPANG SEGUNTING 3',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 220.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KEJORA',
            'alamat' => 'KUPANG PANJAAN 4/31',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 126.58,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KUPAS',
            'alamat' => 'KUPANG SEGUNTING 1',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 379.64,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'AMANAH',
            'alamat' => 'SURABAYAN GG 4 NO 36',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 392.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAROKAH',
            'alamat' => 'SURABAYAN GG 3 NO 40',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 255.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAROKAH 2',
            'alamat' => 'SURABAYAN GG 3 NO 28',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 435.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BINA LINGKUNGAN',
            'alamat' => 'KEDUNG KLINTER VII/12',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 145.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'IDOLA RMH',
            'alamat' => 'KEDUNG KLINTER VII',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 276.04,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERES 05',
            'alamat' => 'JL DINOYO LANGGAR 10',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 163.59,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DINOYO R351K',
            'alamat' => 'DINOYO X/06',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 130.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GRASITU',
            'alamat' => 'DINOYO TANGSI I/8A',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 116.44,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KAMPUNG DINOYO',
            'alamat' => 'DINOYO TENGAH 32',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 255.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KAMPUNG DINOYO',
            'alamat' => 'JL. DINOYO TANGSI 3/5',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 198.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KATUT 04',
            'alamat' => 'JL DINOYO LOR 5/18',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 327.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKAR JAYA',
            'alamat' => 'JL DOHO NO. 43',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 230.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BIANG LALA',
            'alamat' => 'Jl. KEDONDONG KIDUL 1/66',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 302.6,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CABE RAWIT',
            'alamat' => 'KEDONDONG KIDUL I NO 85 C',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 139.73,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAHLIA',
            'alamat' => 'KEDONDONG KIDUL 1/95',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 268.64,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'FLAMBOYAN',
            'alamat' => 'JL. KAMPUNG MALANG WETAN 1/18',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 384.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GAPAPA WES',
            'alamat' => 'JL.PANDEGILING 4/26',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 212.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKMUR JAYA',
            'alamat' => 'JL. KEDONDONG KIDUL 1/70',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 236.66,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKTOR SAMPAH BERKAH 10',
            'alamat' => 'KEDONDONG KIDUL 1/64',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 211.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER BAROKAH',
            'alamat' => 'JL. KAMPUNG MALANG TENGAH 5/40',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 267.95,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAS PECAH (MASYARAKAT PECINTA SAMPAH)',
            'alamat' => 'WONOREJO II/29 (POS RT, 02)',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 250.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MULYA JAYA',
            'alamat' => 'WONOREJO IV/102',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 397.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'REJO ASRI 76',
            'alamat' => 'WONOREJO IV/73',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 179.27,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WIJAYA KUSUMA',
            'alamat' => 'WONOREJO 2/29',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 260.41,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRIKANDI MANDIRI',
            'alamat' => 'JALAN DUKUH PAKIS IV',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 194.42,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TERATAI',
            'alamat' => null,
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 176.44,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BRAYON (BANK GOTONG ROYONG)',
            'alamat' => 'GUNUNGSARI IV',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 383.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SINAR SEJAHTERA 2',
            'alamat' => 'GUNUNGSARI IV GANG KUNIR',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 152.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ASRI LESTARI PKK RW 4',
            'alamat' => 'JL. DUKUH MENANGGAL XI / 21',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 221.91,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BELIMBING WULUH',
            'alamat' => 'JL. MENANGGAL INDAH III',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 210.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ELING RESIK PKK RT 2',
            'alamat' => 'JL. DUKUH MENANGGAL XI / 29',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 200.15,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GANAM SARI',
            'alamat' => 'JL. DUKUH MENANGGAL III NO. 17',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 110.79,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KERTOMENANGGAL BERSERI',
            'alamat' => 'JL. KERTOMENANGGAL',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 123.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANCASILA',
            'alamat' => 'JL. BAMBE DUKUH MENANGGAL',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 184.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PELANGI',
            'alamat' => 'JL. DUKUH MENANGGAL IX',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 493.42,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUSUN MENANGGAL PAK NARTO',
            'alamat' => 'JL RUSUN MENANGGAL BLOK 18',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 184.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ADINIUM MANDIRI',
            'alamat' => 'JL. GAYUNGAN I NO. 15',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 330.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PELANGI SMART',
            'alamat' => 'Jemur gayungan I',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 487.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAGA',
            'alamat' => 'Jl. Gayungan 8',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 193.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERLIAN',
            'alamat' => 'JL. KETINTANG BARU IX/27',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 272.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BINTANG WIYATA RT 1',
            'alamat' => null,
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 129.42,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GKS (Gerakan Kendali Sampah)',
            'alamat' => 'JL.GAYUNGKEBONSARI XI NO 9',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 374.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KBS 5',
            'alamat' => 'JL. KETINTANG BARU V',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 394.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KETINTANG 17',
            'alamat' => 'KETINTANG BARU XVII/47',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 396.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KETINTANG BAROKAH',
            'alamat' => 'KETINTANG BARU VI NO 11',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 547.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LINGKUNGAN BERSIH 3 (LINGBER 3)',
            'alamat' => 'JL. KETINTANG BARAT 1',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 126.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MERAK ASRI',
            'alamat' => 'JL.KETINTANG PRATAMA POS',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 153.05,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PESONA WIYATA 4',
            'alamat' => 'JL. KETINTANG WIYATA IV RW 4',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 375.59,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PUSVETMA',
            'alamat' => 'JLN. A YANI 68 - 70 SURABAYA',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 274.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEPULUH',
            'alamat' => 'Jl;KETINTANG BARU 10/24',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 301.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WAHYU CELL MANDIRI',
            'alamat' => 'GAYUNG KEBONSARI I/16',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 221.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WOLU',
            'alamat' => 'JL.KETINTANG BARU XIV/23',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 292.35,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAHKOTA JIWA',
            'alamat' => 'JL. PAGESANGAN BLOK 69',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 233.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WISMEN LESTARI',
            'alamat' => 'Jl.TAMAN WISMA MENANGGAL',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 164.35,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => '46',
            'alamat' => 'JL. JAMBANGAN VII A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 494.21,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BECIK RESIK',
            'alamat' => 'JAMBANGAN NO 30',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 147.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BINTANG 5',
            'alamat' => 'JAMBANGAN SAWAH BLOK D-46 (BALAI RW. 05)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 349.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BINTANG LIMA',
            'alamat' => 'JL. JAMBANGAN SAWAH D-48',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 353.66,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CEMPAKA',
            'alamat' => 'JL. JAMBANGAN BARU SELATAN GG 5',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 178.97,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DIANSATI RT 6',
            'alamat' => 'JAMBANGAN RT 6',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 138.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ENAM',
            'alamat' => 'JL. JAMBANGAN 9 NO. 42',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 80.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GIRLI',
            'alamat' => 'JL. JAMBANGAN X',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 138.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN',
            'alamat' => 'JL. JAMBANGAN KEBON AGUNG I A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 109.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HILDA REGENCY',
            'alamat' => 'JL. PERUM HILDA REGENCY NO 29 A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 480.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JAMBANGAN RW. 06',
            'alamat' => 'JAMBANGAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 293.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JAS KEMBANG',
            'alamat' => 'JL.JAMBANGAN BARU GANG 2 TOL',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 173.63,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LIDAH BUAYA',
            'alamat' => 'JAMBANGAN 7E',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 400.36,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI',
            'alamat' => 'JL. JAMBANGAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 227.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PITOE JAMBANGAN',
            'alamat' => 'JAMBANGAN TAMA NO. 06',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 171.96,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN JAYA',
            'alamat' => 'JAMBANGAN SAWAH NO, 15 (JAMBANGAN VII-B/01)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 299.83,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMANGAT',
            'alamat' => 'JL. JAMBANGAN 2A NO. 1 B',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 90.04,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SIJI',
            'alamat' => 'JL. JAMBANGAN VIIB',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 423.12,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TEMA RT 5',
            'alamat' => 'JAMBANGAN RT 5',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 90.35,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WOLU',
            'alamat' => 'JAMBANGAN KEBON AGUNG ASRI I (POS RT. 08)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 424.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BIBIS KARAH',
            'alamat' => 'BIBIS KARAH I/02',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 292.19,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANGGA MADU',
            'alamat' => 'JL. KARAH II NO. 21 RT. 03, RW. 02',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 213.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANGGA MANALAGI',
            'alamat' => 'JL. KARAH II NO. 14',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 83.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'APEL',
            'alamat' => 'JL. KEBONSARI GG SLAMET',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 91.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DELIMA CERIA',
            'alamat' => 'JL. KEBONSARI GANG II A NO. 11,',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 463.59,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANGGA',
            'alamat' => 'JL. KEBONSARI I',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 288.83,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANGGIS',
            'alamat' => 'JL. KEBONSARI TENGAH GANG SEJATI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 94.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MERAPAT',
            'alamat' => 'JL. KEBONSARI VIIA (POS KAMLING)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 492.52,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'NEMBANG (RT 6 BERKEMBANG)',
            'alamat' => 'KEBONSARI V',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 129.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SARINEM',
            'alamat' => 'JL. KEBONSARI II',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 198.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMANGKA',
            'alamat' => 'JL. KEBONSARI GANG I NO. 25',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 164.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TUMBUH KEMBANG',
            'alamat' => 'JL. KEBONSARI III',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 279.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARGESS',
            'alamat' => 'PAGESANGAN II',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 406.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GESANG GUYUB',
            'alamat' => 'PAGESANGAN III BUNTU',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 237.17,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN',
            'alamat' => 'PAGESANGAN IIIB',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 384.48,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HIDUP SEJAHTERA',
            'alamat' => 'PAGESANGAN I/28',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 81.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HIJAU ASRI',
            'alamat' => 'PAGESANGAN ASRI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 486.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'IJO RESIK',
            'alamat' => 'PAGESANGAN IV RW 3 (LAPANGAN)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 345.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JAYA ASRI',
            'alamat' => 'PAGESANGAN ASRI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 443.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LADYS SQUAD',
            'alamat' => 'PAGESANGAN RT 3',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 63.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANGIVERA RT 3',
            'alamat' => 'KEL. PAGESANGAN, KEC. JAMBANGAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 87.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MELATI PUTIH',
            'alamat' => 'PAGESANGAN TIMUR TOL',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 142.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SABAR (SAMPAH BAROKAH)',
            'alamat' => 'PAGESANGAN 4 NO. 52 (MASJID AL-HIDAYAH)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 92.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEHATI',
            'alamat' => 'JL. PAGESANGAN IA',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 61.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEROJA RT 4',
            'alamat' => 'KEL. PAGESANGAN, KEC. JAMBANGAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 327.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TERPADU',
            'alamat' => 'PAGESANGAN I',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 456.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH RT 4',
            'alamat' => 'JL. PASOPATI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 182.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JALA MARINA',
            'alamat' => 'JL. PASOPATI 23',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 343.62,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KUMBANG',
            'alamat' => 'JL. KARANG PILANG GG KAWI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 112.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKAR JAYA',
            'alamat' => 'KARANGPILANG MELATI 1',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 350.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TANGGUH',
            'alamat' => 'JL. KARANG PILANG GG RAJAWALI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 216.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ABADI',
            'alamat' => 'JL. KEBRAON',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 394.64,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BELING MITRA (BERSIH LINGKUNGAN MITRA)',
            'alamat' => 'KEBRAON MITRA SATWA 1',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 414.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DALANE SUGEH',
            'alamat' => 'KEBRAON MITRA SATWA II/66',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 340.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARYA SEJAHTERA',
            'alamat' => 'KEBRAON INDAH PERMAI BLOK D-20',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 69.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KDRT',
            'alamat' => 'KEBRAON GG DURIAN RT 3 RW 02',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 422.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR BERSEMI',
            'alamat' => 'KEMLATEN GG 7 NO. A-8',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 110.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MULYO BARENG',
            'alamat' => 'JL. MASTRIP KEMLATEN 8 NO. 17',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 359.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RAMAH BUMI',
            'alamat' => 'GRIYA KEBRAON TENGAH X BLOK V – 15',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 257.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SERTU',
            'alamat' => 'GRIYA KEBRAON UTARA 11 AO 16',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 409.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER REZEKI',
            'alamat' => 'JL. KEMLATEN VI NO. 27',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 356.63,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JITU',
            'alamat' => 'JL. KEDURUS I B 34 SURABAYA',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 136.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MITRA BAROKAH',
            'alamat' => 'JL. BOGANGIN BARU BLOK K NO 34',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 86.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HARAPAN MAJU',
            'alamat' => 'WARUGUNUNG GG MAKAM BULU PINGGIR',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 221.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GENAH URIP',
            'alamat' => 'JL. BANYU URIP KIDUL 10 E',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 265.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUP RUKUN',
            'alamat' => 'JL. BANYU URIP WETAN 3D',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 441.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HATINYA RT 10',
            'alamat' => 'KEL. BANYU URIP, KEC. SAWAHAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 474.05,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI',
            'alamat' => 'JL. BANYU URIP KIDUL 6F NO. 2',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 181.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MOLIN JAYA',
            'alamat' => 'JL. BANYU URIP KIDUL MOLIN 2B',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 251.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANDANG GENDHIS RT 10',
            'alamat' => 'KEL. BANYU URIP, KEC. SAWAHAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 330.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PUNGJI',
            'alamat' => 'JL. BANYU URIP KIDUL V NO. 31',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 498.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN MAKMUR RT 4',
            'alamat' => 'KEL. BANYU URIP, KEC. SAWAHAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 315.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN SEHAT',
            'alamat' => 'JL. BANYU URIP WETAN 3B',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 123.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI RT 2',
            'alamat' => null,
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 407.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SONGO LORO',
            'alamat' => 'JL. PETEMON TIMUR BUNTU A NO. 5',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 398.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TIRTA KUSUMA RT 3',
            'alamat' => null,
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 309.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GADIS',
            'alamat' => 'PAKIS TIRTOSARI XI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 469.6,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN',
            'alamat' => 'KEL. PAKIS, KEC. SAWAHAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 330.62,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SANSIVERA',
            'alamat' => 'PAKIS SIDOREJO III/12',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 323.95,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAWIS 4/5',
            'alamat' => 'JL. PENANGGUNGAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 401.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAWIS 6/7',
            'alamat' => 'SIMO SIDOMULYO 6/2',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 127.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GEMILANG',
            'alamat' => 'JL. SIMO SIDOMULYO IX',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 365.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GMH RT 2',
            'alamat' => 'SIMO SIDOMULYO 4 49',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 94.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI',
            'alamat' => 'JL. PENANGGUNGAN NO 34 A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 194.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MONCITERO',
            'alamat' => 'JL. PETEMON SIDOMULYO KALIGREGES 20 A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 64.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PITU MANDIRI',
            'alamat' => 'SIMO SIDOMULYO X/120',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 471.97,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRIKANDI',
            'alamat' => 'PENANGGUNGAN (POS RT. 03)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 124.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAUN HIJAU',
            'alamat' => 'JL. KEDUNG ANYAR 8 NO. 20',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 78.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GASPOLL',
            'alamat' => 'JL. KEDUNG ANYAR BUNTU 1 - A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 273.33,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GEMILANG SEJAHTERA',
            'alamat' => 'JL. KEDUNG ANYAR 8 NO. 43',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 457.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARTES',
            'alamat' => 'JL. KEDUNG ANYAR VII NO. 38',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 446.83,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WANI RESIK',
            'alamat' => 'JL. KEDUNG ANYAR VIII NO. 55',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 139.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WOLU SONGO',
            'alamat' => 'JL. KEDUNG ANYAR IX (POS RT 08)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 279.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BINTANG MANGROVE',
            'alamat' => 'JL. BABATAN INDAH B10 NO. 01',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 152.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CERIA',
            'alamat' => 'JL. PERUMAHAN BABATAN INDAH (BALAI RW IV)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 150.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR',
            'alamat' => 'JL. BABATAN PILANG 7',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 348.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR 88',
            'alamat' => 'JL. BABATAN INDAH B8',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 333.15,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MELATI 1',
            'alamat' => 'JL. BABATAN PILANG 2 NO. 1',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 197.44,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MELATI 2',
            'alamat' => 'JL. BABATAN INDAH A5 NO. 2',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 125.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MITRA ROSAN',
            'alamat' => 'JL. KARANGAN MULYA VI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 68.16,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKTORAL ANGGREK',
            'alamat' => 'JL. BABATAN PILANG GANG III',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 145.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TERATAI 12',
            'alamat' => 'JL. BABATAN PILANG GG. XII (BALAI RT)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 190.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TERATAI 3',
            'alamat' => 'JL. BABATAN PILANG III',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 132.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DUA ENAM',
            'alamat' => 'JL. KARANG KLUMPRIK SELATAN V',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 474.17,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RAJIN',
            'alamat' => 'PONDOK MARITIM INDAH BLOK PP NO. 5',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 447.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SALING KERJA RT 6',
            'alamat' => 'RESIDENSI ALAMUDA',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 89.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HARAPAN JAYA',
            'alamat' => 'JL. GOGOR MAKAM 3 NO. 28B',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 450.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KALI MAKMUR',
            'alamat' => 'JL. DUKUH GEMOL KALI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 491.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TIGA 7',
            'alamat' => 'JL. WIYUNG INDAH (TAMAN PONDOK INDAH)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 310.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TUNAS MEKAR 1',
            'alamat' => 'JL. JARSONGO 2 NO. 24',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 443.43,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TUNAS MEKAR 2',
            'alamat' => 'JL. JARSONGO',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 178.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ALAM LESTARI',
            'alamat' => 'WIYUNG I/63A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 195.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAKTI PERTIWI',
            'alamat' => 'TAMAN PONDOK INDAH BLOK TX-05',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 366.79,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CERIA',
            'alamat' => 'TAMAN PONDOK INDAH XI (POS RT, 04)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 361.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAMAI',
            'alamat' => 'JL. WIYUNG',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 211.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MATAHARI',
            'alamat' => 'JL. TAMAN PONDOK INDAH BLOK AY',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 287.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MY DARLING',
            'alamat' => 'JL. BENDUL MERISI GANG 8/16',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 272.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TALES MERDEKA SAMPAH',
            'alamat' => 'JL. TALES III NO. 1 KAMPUNG TALES RT. 02, RW. 10',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 176.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAHONI',
            'alamat' => 'JL. WONOCOLO KH. ZUBAIR 8 - 10',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 227.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MUGI LESTARI',
            'alamat' => 'WONOCOLO GANG BENTENG I/31',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 97.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JW PROJECT',
            'alamat' => 'JETIS WETAN VI/15',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 108.22,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARYA MANDIRI',
            'alamat' => 'MARGOREJO SAWAH NO, 3A',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 212.74,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAREM F',
            'alamat' => 'JL. MARGOREJO 4F/115',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 258.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MARTALIM',
            'alamat' => 'JL. MARGOREJO TANGSI V NO. 14',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 127.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MARTASIK',
            'alamat' => 'JL MARGOREJO TANGSI IV NO 22',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 309.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SIDO MAKMUR',
            'alamat' => 'JL. SIDOSERMO 3 NO. 10',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 228.36,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LANG SRIKANDI',
            'alamat' => 'SIWALANKERTO SELATAN',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 328.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CADETS 07',
            'alamat' => 'DARMOKALI II/06',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 146.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HIJAU LESTARI',
            'alamat' => 'JL.KUTAI 1/20',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 233.41,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KINTAMANI',
            'alamat' => 'KINTAMANI NO. 11',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 347.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KALIMIR SEJAHTERA',
            'alamat' => 'BAGONG GINAYAN I/01',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 368.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'NGAGEL SEJAHTERA',
            'alamat' => 'NGAGEL NO, 11 (BALAI KELURAHAN)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 203.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAROKAH',
            'alamat' => 'JL NGAGEL MULYO 6/8D',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 300.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB SAYEKTI',
            'alamat' => 'NGAGEL MULYO I-A/11B',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 158.46,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MULYO RAHAYU',
            'alamat' => 'NGAGEL MULYO NO, 16',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 325.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MULYOREJO',
            'alamat' => 'NGAGEL MULYO VI/08',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 152.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RAFFLESIA',
            'alamat' => 'KRUKAH LAMA BUNTU NO. 09',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 368.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SIJI OKE',
            'alamat' => 'JL. KRUKAH LAMA 5 NO. 5',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 221.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PUCUK CANTIK',
            'alamat' => 'JL. PULO WONOKROMO WETAN 6 / 25 F',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 123.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUBAIR ASRI',
            'alamat' => 'RT 05 KEL, AIRLANGGA, KEC, GUBENG',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 328.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PAKAR RT. 03',
            'alamat' => 'LAPANGAN DHARMAWANGSA',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 229.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RESIK GUBARPAT',
            'alamat' => 'RT 07 KEL, AIRLANGGA, KEC, GUBENG',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 150.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BARATA BERJAYA',
            'alamat' => 'JL. BARATAJAYA VI / 22',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 388.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GOTONG ROYONG 1',
            'alamat' => 'BRATANG BINANGUN V/35',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 113.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GOTONG ROYONG 7',
            'alamat' => 'JL, BRATANG BINANGUN III NO 1 RT 7 RW 8',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 108.15,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUP SEJAHTERA',
            'alamat' => 'JL. BARATAJAYA 2A/62',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 100.38,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KEMUNING INDAH',
            'alamat' => 'JL. BARATAJAYA 2/58',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 128.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKMUR JAYA',
            'alamat' => 'JL. BARATAJAYA 2A / 18',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 351.61,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI',
            'alamat' => 'JL. BARATAJAYA IV/73',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 90.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BOGGI JAYA',
            'alamat' => 'JL, GUBENG JAYA II KA NO, 34 RT, 01, RW, 02',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 78.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DARLING (SADAR LINGKUNGAN)',
            'alamat' => 'GUBENG KERTAJAYA I/64',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 357.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUBENG JAYA MANDIRI',
            'alamat' => 'GUBENG JAYA VI/16B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 170.43,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUBENG JAYA RT. 18',
            'alamat' => 'GUBENG JAYA VIII',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 326.26,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUBJA RT. 10',
            'alamat' => 'GUBENG JAYA',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 96.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUBSI JAYA',
            'alamat' => 'GUBENG KLINGSINGAN V/72 (BALAI RW, 03)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 125.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'IJO ROYO ROYO',
            'alamat' => 'GUBENG JAYA LANGGAR NO, 05',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 309.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PKK',
            'alamat' => 'JL, GUBENG JAYA GANG IX RT,19, RW, 02',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 203.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JUWINGAN GEMILANG',
            'alamat' => 'JL JUWINGAN 136',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 345.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PILAH JAYA',
            'alamat' => 'JL, GUBENG JAYA NO, 4B - 39',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 290.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKAR JAYA',
            'alamat' => 'PUCANGAN II/07',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 391.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'AMANAH',
            'alamat' => 'JOJORAN I BLOK N',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 327.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANGGREK BERSERI',
            'alamat' => 'JOJORAN BARU 1 NO.57A',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 463.59,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANUGERAH JAYA',
            'alamat' => 'MOJO KLANGGRU 10R 1/',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 291.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARJO MATIM',
            'alamat' => 'JOJORAN V TIMUR',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 312.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'B.I.A',
            'alamat' => 'MOJO KLANGGRU 160',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 195.04,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BANGKIT BERSERI',
            'alamat' => 'JOJORAN 3 NO.113',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 95.19,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BANGKIT JAYA',
            'alamat' => 'KR.MENJANGAN IIIB/POS RT03',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 449.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BAROKAH',
            'alamat' => 'KEDUNG TARUKAN BARU 4',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 250.39,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH',
            'alamat' => 'KEDUNG TARUKAN BARU 4A',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 105.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH SENTOSA',
            'alamat' => 'KEDUNG TARUKAN BARU 4E',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 120.15,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CAHAYA BERKAH',
            'alamat' => 'MOJO KIDUL RAYA 8TOG',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 163.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GACEE',
            'alamat' => 'KEDUNG TAR.BAR 3C',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 85.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GARUDA 106',
            'alamat' => 'KEDUNG TARUKAN BARU 4E',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 339.26,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GIAT 14',
            'alamat' => 'JOJORAN 3A NO.5',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 63.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GOYONG ROYONG',
            'alamat' => 'MOJO 3 E DALAM',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 343.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN',
            'alamat' => 'KALIDAMI 8/25',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 251.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HARAPAN MULYA',
            'alamat' => 'KEDUNG PENGKOL 1/48 B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 315.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'HOLOBIS',
            'alamat' => 'KEDUNG TARUKAN BARU 4D',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 353.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JAYA ABADI',
            'alamat' => 'MOJO KLANGGRU LOR 130',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 182.26,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'JORDHE',
            'alamat' => 'JOJORAN 3D ( POS RT 10 )',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 142.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KADARSIH',
            'alamat' => 'KALIDAMI RAYA',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 376.74,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KAWAN',
            'alamat' => 'JOJORAN BARU 3 NO.30',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 61.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KEBON PRING',
            'alamat' => 'MOJO KLANGGRU LOR 18',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 417.12,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KEMUNING',
            'alamat' => 'JOJORAN BARU NO.41',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 279.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KITA BISA',
            'alamat' => 'KEDUNG TARUKAN BARU 1/',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 349.67,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LANCAR BERSAMA',
            'alamat' => 'MOJO KLANGGRU LOR II/10',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 375.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LESTARI',
            'alamat' => 'KEDUNG TAR BAR 2B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 346.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LIMA MANDIRI',
            'alamat' => 'JOJORAN BARU 3 DLM NO.21',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 492.52,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU BERSAMA RW 05 RT 05',
            'alamat' => 'KEDUNG PENGKOL 1/47',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 106.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU BERSAMA RW 12 RT 09',
            'alamat' => 'JOJORAN BARU 3E NO.15',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 406.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU JAYA',
            'alamat' => 'KEDUNG PENGKOL',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 117.67,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKMUR JAYA',
            'alamat' => 'KALIWARON 46',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 331.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR PUTIH',
            'alamat' => 'JOJORA BARU 3 NO.141',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 81.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MELATI HARIM',
            'alamat' => 'MENCER 3 KOMPLEK KMS',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 424.94,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MELATI PUTIH',
            'alamat' => 'RAYA KALIDAMI 32',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 303.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MOJO CANTIK',
            'alamat' => 'MOJO KLANGGRU BARU 4',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 386.73,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MOJO IJO',
            'alamat' => 'MOJO KLANGGRU LOR 68E',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 130.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MOJO TRI',
            'alamat' => 'MOJO 3/16',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 330.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'NUSA INDAH',
            'alamat' => 'KEDUNG TARUKAN BARU 4B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 486.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PALEM',
            'alamat' => 'JOJORAN BARU 2 NO.18',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 129.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANCA TIRTA MAYA',
            'alamat' => 'KALIDAMI 9',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 91.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PEDULI SEHAT',
            'alamat' => 'JOJORAN 3B NO.24',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 92.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PUNDI MOJO',
            'alamat' => 'BUMI MOJO 4/48',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 187.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RAMAH',
            'alamat' => 'JOJORAN I/85',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 87.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RESTU ABADI',
            'alamat' => 'KR.MENJANGAN II/28B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 113.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN SEJAHTERA',
            'alamat' => 'KEDUNG TAR BAR 3 A',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 465.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBUNG URIP',
            'alamat' => 'JOJORAN 3E DLM NO.5',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 345.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SATYA BHAVANA',
            'alamat' => 'KARANG MENJANGAN 3D',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 202.22,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEDAP MALAM',
            'alamat' => 'JOJORAN 3C NO.27',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 384.48,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEJAHTERA',
            'alamat' => 'JOJORAN BARU 2A NO.45',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 486.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKAR',
            'alamat' => 'KEDUNG TAR,BAR 1',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 334.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKAR WANGI',
            'alamat' => 'MOJO 1/16',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 129.26,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SESARING',
            'alamat' => 'KALIDAMI 7',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 75.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SETIA ABADI',
            'alamat' => 'KEDUNG PENGKOL 3',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 365.57,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEWELAS',
            'alamat' => 'JOJORAN 3D DLM NO.46',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 237.17,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SIKAMRO',
            'alamat' => 'KALIDAMI 6/21',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 426.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRI REJEKI',
            'alamat' => 'JOJORAN 3 NO.75',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 443.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRIKANDI',
            'alamat' => 'KR.MENJANGAN 1B/48',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 107.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRIKANDI 09',
            'alamat' => 'MOJO KLANGGRU LOR 100',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 95.46,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'STEL KENDO',
            'alamat' => 'KEDUNG TARUKAN BARU 3 B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 435.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUKA SUKA',
            'alamat' => 'JOJORAN BARU 4 NO.3',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 456.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TANJUNG JAYA',
            'alamat' => 'KEDUNG PENGKOL5/4',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 459.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KALIBOKOR KENCANA',
            'alamat' => 'JL, KALIBOKOR KENCANA 2/7C RT 06 RW 05',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 350.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANDIRI SEJAHTERA',
            'alamat' => 'PUCANG SAWIT NO. 23',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 216.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BINTANG MANGROVE',
            'alamat' => 'JL, GUNUNG ANYAR TAMBAK RT 03 RW 01',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 112.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PGR BERSINAR',
            'alamat' => 'PURI GUNUNG ANYAR REGENCY',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 69.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKMI',
            'alamat' => 'GUNUNG ANYAR MAS XVI (POS RT. 02)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 394.64,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER DANA',
            'alamat' => 'WISMA INDAH II',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 343.62,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WINDU BERKAH',
            'alamat' => 'WISMA INDAH II K12 RT 001 RW 007',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 182.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARENA (AREK RT. 06)',
            'alamat' => 'RUNGKUT MENANGGAL HARAPAN BLOK R (POS RT. 06)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 356.63,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'IDOLA RMH',
            'alamat' => 'RUNGKUT MENANGGAL HARAPAN BLOK H-46',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 359.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TMB MANDIRI 2',
            'alamat' => 'TEGAL MULYOREJO BARU NO, 47 (POS RT, 02)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 422.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANYAR BERSERI',
            'alamat' => 'MANYAR SABRANGAN IV',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 340.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MANYAR MANDIRI',
            'alamat' => 'MANYAR SABRANGAN IX MAKAM NO, 96',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 414.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GOKLIN',
            'alamat' => 'JL, MEJOYO GANG BUNTU NO, 6',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 257.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAKURA MAS',
            'alamat' => 'JL, RUNGKUT LOR VII MASJID NO, 24',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 221.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAKURA MULYA',
            'alamat' => 'RUNGKUT LOR VII DALAM NO 05-B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 86.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAKURA RAYA',
            'alamat' => 'JL, RUNGKUT LOR 7 NO, 26',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 409.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER REJEKI',
            'alamat' => 'JI. MEDOKAN ASRI TIMUR RL V',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 110.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BUNAKEM',
            'alamat' => 'WISMA KEDUNG ASEM BLOK L-01',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 251.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKMUR SEJAHTERA',
            'alamat' => 'JL, KEDUNG BARUK VI / 20A RT 1 RW 4',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 136.07,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARSA RUMAH SAMPAH',
            'alamat' => 'MEDAYU SELATAN XI BLOK J-36',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 123.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SRI REJEKI',
            'alamat' => 'MEDOKAN ASRI BARAT IV-1F/54',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 498.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKAR SARI',
            'alamat' => 'KENDALSARI I/23 NO. 59',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 265.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMANGGI',
            'alamat' => 'PANDUGO BARU XIII/03',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 181.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANYELIR 2',
            'alamat' => 'JL, RUNGKUT ASRI TIMUR VII/30',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 330.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANYELIR 3',
            'alamat' => 'JL, RUNGKUT ASRI TIMUR 6',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 474.05,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TERATAI',
            'alamat' => 'JL, RUNGKUT ASRI BARAT VI BALAI RW XII',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 315.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARYA GUNA',
            'alamat' => 'KEPUTIH I-D/14',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 441.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CENDRAWASIH',
            'alamat' => 'KLAMPIS NGASEM III/49',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 407.69,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MLETO MAJU BERSAMA',
            'alamat' => 'MLETO GANG PASAR',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 309.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'USAH CERIA',
            'alamat' => 'KLAMPIS NGASEM NO, 119',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 398.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MASIDOSI 1',
            'alamat' => 'MEDOKAN SEMAMPIR BLOK E-34A',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 469.6,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MASIDOSI 2',
            'alamat' => 'MEDOKAN SEMAMPIR BLOK G-01 (POS RT, 02)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 323.95,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MASIDOSI 3',
            'alamat' => 'MEDOKAN SEMAMPIR (POS RT, 03)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 330.62,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MASIDOSI 4',
            'alamat' => 'MEDOKAN SEMAMPIR (POS RT, 04)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 124.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MASIDOSI 6',
            'alamat' => 'MEDOKAN SEMAMPIR BLOK M-17',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 365.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SURYA ABADI MANDIRI',
            'alamat' => 'JL, MEDOKAN SEMAMPIR BLOK C NO, 27',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 471.97,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BANK SAMPAH 95',
            'alamat' => 'NGINDEN VI-I (POS RT. 09)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 401.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CERIA NGINDEN',
            'alamat' => 'NGINDEN VI-B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 94.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAHLIA',
            'alamat' => 'NGINDEN VI-C/50',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 64.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MESEM',
            'alamat' => 'SEMOLOWARU BAHARI BLOK XIV (SEBELAH POS RT, 02)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 127.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBERIA 1 (SAMPAH BERSIH WARGA CERIA)',
            'alamat' => 'SEMOLOWARU BAHARI I/21',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 194.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBERIA 2 (SAMPAH BERSIH WARGA CERIA)',
            'alamat' => 'SEMOLOWARU BAHARI IV/23',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 273.33,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBERIA 3 (SAMPAH BERSIH WARGA CERIA)',
            'alamat' => 'SEMOLOWARU BAHARI VI (POS RT. 3)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 78.29,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SAMBERIA 4 (SAMPAH BERSIH WARGA CERIA)',
            'alamat' => 'SEMOLOWARU BAHARI VI',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 457.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MITRA KGM',
            'alamat' => 'KAPAS GADING MADYA GG 5 NO 16',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 446.83,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'NUSA INDAH',
            'alamat' => 'LEBAK INDAH UTARA I/77 (POS RT. 01)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 279.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMANGAT GUYUB RUKUN',
            'alamat' => 'KAPAS GADING MADYA 3A NO 56',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 139.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'EVORBIA',
            'alamat' => 'JL, DUKUH SETRO 1 TENGAH NO, 16 RT 1 RW VIII',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 150.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TRISNO JAYA',
            'alamat' => 'KAPAS MADYA 2/46',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 125.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BUGERS',
            'alamat' => 'JL, GERSIKAN VI/17',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 333.15,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KEMUNING',
            'alamat' => 'BALAI RW 10 PACAR KELING II LAPANGAN',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 152.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SABANDAWA',
            'alamat' => 'KEDUNG SROKO III/06',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 197.44,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MY DARLING',
            'alamat' => 'KENDANGSARI II',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 348.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RESMAN 06',
            'alamat' => 'KENDANGSARI VII/12',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 145.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'DAHLIA',
            'alamat' => 'KUTISARI IV (BALAI RT 01)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 68.16,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PAMEVI',
            'alamat' => 'JL, PANJANG JIWO GG 8/23',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 250.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RUKUN MULYA',
            'alamat' => 'JL, TENGGILIS MULYA GG VII',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 107.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUKSES JAYA',
            'alamat' => 'TENGGILIS MULYO VI/95',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 120.2,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MATAHARI',
            'alamat' => 'BULAK CUMPAT BARAT V',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 99.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR',
            'alamat' => 'BULAK CUMPAT BARAT IV/I',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 250.73,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RIZKY SEJAHTERA',
            'alamat' => 'BULAK CUMPAT UTARA I/42',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 119.81,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SERUNI',
            'alamat' => 'BULAK CUMPAT BARAT II',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 144.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'QORYAH THOYYIBAH',
            'alamat' => 'SUKOLILO 104',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 400.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANGGRAENI',
            'alamat' => 'PLATUK DONOMULYO 2/35',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 115.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANJANI',
            'alamat' => 'PLATUK DONOMULYO I/89',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 190.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BEST OK 9',
            'alamat' => 'JL. KEDUNG MANGU GANG 9 SURABAYA',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 123.22,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'CERIA',
            'alamat' => 'KEDUNG MANGU SELATAN 2/20',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 300.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARTINI MODEREN',
            'alamat' => 'JL. KEDUNG MANGU GANG 10',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 111.57,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KEMANG TSAMANIAH MANDIRI',
            'alamat' => 'JL. KEDUNG MANGU 8 SURABAYA',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 308.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LANCAR JAYA',
            'alamat' => 'KEDUNGMANGU SELATAN RT 10',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 500.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAJU BERSAMA',
            'alamat' => 'KEDUNG MANGU SELATAN 4/50',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 205.48,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKMUR SENTOSA',
            'alamat' => 'KEDUNG MANGU SELATAN III',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 461.22,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PIONEER',
            'alamat' => 'JL. KEDUNG MANGU 7/4 SURABAYA',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 789.21,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEKAR SARI',
            'alamat' => 'PLATUK DONOMULYO GANG 5 NO 17',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 136.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEMBODRO',
            'alamat' => 'PLATUK DONOMULYO UTARA 1A',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 300.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUNFLOWER',
            'alamat' => 'PLATUK DONOMULYO G1A NO 11',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 152.33,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANGGREK',
            'alamat' => 'JL TAMBAK WEDI BARU IX',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 465.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ASRI',
            'alamat' => 'JL. TAMBAK WEDI GANG GARUDA NO. 10',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 87.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN',
            'alamat' => 'NAMBANGAN JL. KEDINDING LOR GANG ARBEI',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 98.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'INDAH SEJAHTERAH',
            'alamat' => 'TAMBAK WEDI INDAH BARAT II',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 106.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TWEBAR 6',
            'alamat' => 'TAMBAK WEDI BARAT 6 NO 40',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 99.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'AHONG',
            'alamat' => 'TANAH MERAH UTARA V',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 350.31,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ARTHA SAMPAH SEJAHTERA',
            'alamat' => 'POGOT VIII/16',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 345.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GUYUB RUKUN KEDINDING',
            'alamat' => 'KEDINDING LOR GANG ARBEI',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 443.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR MERAH',
            'alamat' => 'JL. TANAH MERAH SELATAN 2 SURABAYA',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 216.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MENTARI',
            'alamat' => 'RUSUN TANAH MERAH SURABAYA',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 112.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PARING BANK',
            'alamat' => 'POGOT BARU 3 NO 31',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 486.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TONGGO RUKUN BERKAH',
            'alamat' => 'POGOT BARU 9/23',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 327.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'UTUN RUKUN',
            'alamat' => 'POGOT BARU NO 23',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 87.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'BERKAH KARYA JAYA',
            'alamat' => 'JL DUPAK BANGUNREJO',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 69.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KAMPUNG MANGGA',
            'alamat' => 'DUPAK BANGUN SARI GG I',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 182.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAKMUR BERSAMA',
            'alamat' => 'DUPAK BANGUNREJO TENGAH I (POS RT. 08)',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 343.62,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'NUSA INDAH',
            'alamat' => 'DUPAK BANDAREJO GG II',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 200.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SUMBER MAKMUR/MAKMUR BERSAMA',
            'alamat' => 'DUPAK BANGUNREJO TENGAH I (POS RT. 07)',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 394.64,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GAUL 11 (GERAKAN UNTUK LINGKUNGAN 11)',
            'alamat' => 'KREMBANGAN BHAKTI XI/45',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 359.03,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GAUL 4 (GERAKAN UNTUK LINGKUNGAN 4)',
            'alamat' => 'KREMBANGAN BHAKTI IV/34',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 356.63,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'UNTUK BERSAMA',
            'alamat' => 'JL. GADUKAN UTARA 7',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 422.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MERPATI',
            'alamat' => 'IKAN KERAPU IV/27',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 414.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MUMPUNI',
            'alamat' => 'KEL. PERAK, KEC, KREMBANGAN',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 257.14,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SYARIAH SAMAWA',
            'alamat' => 'IKAN KERAPU VI/07',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 340.51,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'WANI',
            'alamat' => 'TELUK ARU IV',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 110.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SONGOLIKOER',
            'alamat' => 'WONOKUSUMO KIDUL NO, 29',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 409.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ANGGREK 12',
            'alamat' => 'SIDOTOPO JAYA LEBAR 51',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 86.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GERABAK PISA',
            'alamat' => 'SIDOTOPO LOR I /18 RW 02',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 221.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'LESTARI',
            'alamat' => 'JL KOMP. HANG TUAH BLOK D­17',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 333.15,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SEJAHTERA HANG TUAH',
            'alamat' => 'KOMPLEK HANG TUAH NO. 01 (BALAI RW. 08)',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 125.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MEKARSARI',
            'alamat' => 'JL. WONOSARI LOR GG 5A',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 197.44,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SARI KUSUMA',
            'alamat' => 'BULAK SARI GG VII',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 152.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN ASEMROWO',
            'alamat' => 'ASEM RAYA NO 6',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 183.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KANDANGAN 1',
            'alamat' => 'RAYA KANDANGAN NO 28­30',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 99.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KANDANGAN 2',
            'alamat' => 'RAYA TENGGER KANDANGAN NO 1',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 129.57,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 61',
            'alamat' => 'TENGGER RAYA NO 13',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 105.57,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KANDANGAN 3',
            'alamat' => 'WISMA TENGGER XXI',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 212.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SEMEMI 1',
            'alamat' => 'KENDUNG NO 122',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 82.66,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 40',
            'alamat' => 'BANGKINGAN VIII NO 8',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 104.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 28',
            'alamat' => 'JL RAYA LIDAH WETAN',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 126.93,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN LIDAH WETAN 2',
            'alamat' => 'RAYA LIDAH WETAN NO 27',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 72.71,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDIT PERMATA',
            'alamat' => 'JL CACAT VETERAN NO 41',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 114.61,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SD TANWIRUL AFKAR',
            'alamat' => 'JL SUMBER REJO NO 1 NO 44',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 116.3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN LONTAR 2',
            'alamat' => 'LEMPUNG PERDANA IV',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 104.05,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN LONTAR 481',
            'alamat' => 'RAYA KUWUHAN NO 42',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 91.99,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 20',
            'alamat' => 'KAPASAN 1',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 87.66,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SURABAYA INTERCULTURAL SCHOOL',
            'alamat' => 'SEKOLAH INTERNASIONAL - CITRALAND',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 104.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 33',
            'alamat' => 'JL. BUKIT DARMO GOLF NO. 03',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 229.79,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 25',
            'alamat' => 'JL. SIMOMULYO NO 25',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 207.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 50',
            'alamat' => 'SUKOMANUNGGAL BLOK C NO 93',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 117.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 26',
            'alamat' => 'BANJAR SUGIHAN NO 21',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 84.44,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN MANUKAN KULON',
            'alamat' => 'MANUKAN REJO BLOK2A',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 91.46,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN TANDES KIDUL 1',
            'alamat' => 'RAYA TANDES LOR NO 94',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 101.27,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN BUBUTAN 4',
            'alamat' => 'JL SEMARANG',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 91.35,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN BUBUTAN 3',
            'alamat' => 'KOBLEN KIDUL NO. 06',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 203.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN GUNDIH',
            'alamat' => 'Dupak No 22',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 108.91,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN JEPARA 1',
            'alamat' => 'PURWODADI RAYA NO. 84',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 104.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN TEMBOK DUKUH',
            'alamat' => 'DEMAK NO 45',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 97.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'OSIS SMK RAJASA',
            'alamat' => 'GENTENG KALI NO. 27',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 135.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 3',
            'alamat' => 'JL PRABAN NO 3',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 98.79,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 41',
            'alamat' => 'GEMBONG SEKOLAHAN NO. 5',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 109.1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 42',
            'alamat' => 'JL. DUPAK RUKUN NO. 63',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 146.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 37',
            'alamat' => 'KALIANYAR NO.18-20',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 158.13,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KAPASARI 8',
            'alamat' => 'KUSUMA BANGSA NO. 124',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 180.72,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KAPASARI 1',
            'alamat' => 'PECINDILAN II NO. 43',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 103.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KAPASARI 5',
            'alamat' => 'TAMBAK DUKUH I/08',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 83.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KETABANG 1',
            'alamat' => 'AMBENGAN NO. 29',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 209.8,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KALIASIN I',
            'alamat' => 'JL GUBERNUR SURYO NO 26',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 158.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMAN 1',
            'alamat' => 'JL WIJAYA KUSUMA 47',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 208.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN DR SOETOMO (BOUGENVILLE)',
            'alamat' => 'JL KUPANG SEGUNTING III NO 12',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 100.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN DR. SOETOMO 5',
            'alamat' => 'TRUNOJOYO NO. 84',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 126.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'MAWAR SHARON CHRISTIAN SCHOOL',
            'alamat' => 'CEMPAKA NO. 06-12',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 150.6,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN DUKUH MENANGGAL 1',
            'alamat' => 'JL DUKUH MENANGGAL 1 NO 3­7 SURABAYA',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 106.96,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'UNIPA',
            'alamat' => 'JL. DUKUH MENANGGAL XII / 4',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 115.39,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 22',
            'alamat' => 'GAYUNGAN BARU X NO 38',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 81.39,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN MENANGGAL',
            'alamat' => 'JL. TAMAN WISMA MENANGGAL NO 35',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 103.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SD DARUL ULUM',
            'alamat' => 'JL KEBON SARI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 89.33,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 36',
            'alamat' => 'JL KEBONSARI SEKOLAHAN NO 15',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 148.17,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KEBONSARI 1',
            'alamat' => 'KEBONSARI SEKOLAHAN NO. 414',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 105.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN BANYU URIP 3',
            'alamat' => 'BANYU URIP KIDUL IV/17',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 100.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PAKIS 3',
            'alamat' => 'DUKUH KUPANG TIMUR XIII/36',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 133.7,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 46',
            'alamat' => 'JL BINTANG DIPONGGO NO 375',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 95.87,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PAKIS 5',
            'alamat' => 'PAKIS SIDOKUMPUL NO 55',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 101.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANTI ASUHAN DON BOSCO I',
            'alamat' => 'JL TIDAR NO 115',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 127.24,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDK SANTO VINCENTIUS',
            'alamat' => 'JL TIDAR NO 115',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 117.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PETEMON',
            'alamat' => 'JL TIDAR NO 121',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 92.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PETEMON 2',
            'alamat' => 'TIDAR 125',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 105.11,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PANTI ASUHAN DON BOSCO II',
            'alamat' => 'TIDAR NO. 115',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 143.84,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SAWAHAN 4',
            'alamat' => 'KEDUNG ANYAR VII/58',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 166.96,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN BABATAN 4',
            'alamat' => 'MENGANTI BABATAN NO 15',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 163.17,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN JAJAR TUNGGAL 3',
            'alamat' => 'RAYA MENGANTI NO 49',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 127.1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN BENDUL MERISI 408',
            'alamat' => 'BENDUL MERISI GG BESAR TIMUR NO 35',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 142.95,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SOSMA HMTL UINSA',
            'alamat' => 'AHMAD YANI NO. 117',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 150.2,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 13',
            'alamat' => 'JEMURSARI II',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 129.81,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'UINSA WONOCOLO',
            'alamat' => 'JL AHMAD YANI NO 117',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 255.34,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SD SANTO CAROLUS',
            'alamat' => 'JL JEMUR ANDAYANI XXI NO 7',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 196.61,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 57',
            'alamat' => 'SIWALANKERTO PERMAI NO 1',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 123.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SD AL FALAH',
            'alamat' => 'TAMAN MAYANGKARA NO. 02-04',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 92.16,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KB/TK IT AL USWAH',
            'alamat' => 'JL NGAGEL JAYA TENGAH I NO 8',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 108.18,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN NGAGEL 1 (PANDU KALPATARU)',
            'alamat' => 'JL. NGAGEL 211 A No. 11 RT 8 RW 1',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 104.43,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN AIRLANGGA 1',
            'alamat' => 'GUBENG AIRLANGGA 1/2',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 94.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 6',
            'alamat' => 'JL. JAWA NO.24,',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 124.83,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KERTAJAYA 9',
            'alamat' => 'PUCANG WINDU NO 1',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 108.79,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMP AL ISLAH',
            'alamat' => 'GUNUNG ANYAR TENGAH NO 22­24',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 75.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN RUNGKUT MENANGGAL 1',
            'alamat' => 'JL. RUNGKUT BARATA 9 NO. 3',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 160.33,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KALIJUDAN 1',
            'alamat' => 'JL KALIJUDAN NO 132',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 189.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KALISARI 2 (BERKAH ILAHI)',
            'alamat' => 'JL TAMAN BHASKARA NO 1',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 155.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMA GLORIA 2',
            'alamat' => 'JL KEJAWAN (EAST COST)',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 174.92,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN MANYAR SABRANGAN 2',
            'alamat' => 'MANYAR SABRNGAN VIII B/ 20B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 118.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 45',
            'alamat' => 'MULYOREJO NO 184',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 102.47,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 17',
            'alamat' => 'RAYA TENGGILIS MEJOYO NO. 01',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 128.26,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN MEDOKAN AYU 1',
            'alamat' => 'RAYA MEDOKAN SAWAH NO 7',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 101.83,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN WONOREJO 1',
            'alamat' => 'WONOREJO II NO 88',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 155.65,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ITS',
            'alamat' => 'KEPUTIH',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 200.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 19',
            'alamat' => 'ARIF RAHMAN HAKIM NO. 103B',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 189.49,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'UNTAG SURABAYA',
            'alamat' => 'SEMOLOWARU NO. 45',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 100.25,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMK 17 AGUSTUS',
            'alamat' => 'JL NGINDEN SEMOLO NO 44',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 121.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SEMOLOWARU 1',
            'alamat' => 'SUKOSEMOLO NO 179',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 135.75,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN GADING 3',
            'alamat' => 'GADING KARYA VII',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 113.16,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PACARKELING 5',
            'alamat' => 'PACAR KELING NO. 07',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 125.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PACAR KEMBANG 1',
            'alamat' => 'JL BRONGGALAN NO 36',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 130.01,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN PLOSO 3',
            'alamat' => 'KARANG EMPAT BESAR NO. 60-62',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 100.47,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN RANGKAH 6',
            'alamat' => 'KAPAS KRAMPUNG NO 49',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 226.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KENDANGSARI 1',
            'alamat' => 'JL KENDANGSARI BLOK S NO.26',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 205.32,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN TENGGILIS MEJOYO 1',
            'alamat' => 'RAYA TENGGILIS MEJOYO NO 1',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 107.47,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN BULAK RUKEM 2',
            'alamat' => 'BULAK RUKEM TIMUR 2 NO 2',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 157.63,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 54',
            'alamat' => 'KYAI TAMBAK DERES NO 280',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 174.82,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 18',
            'alamat' => 'BAMBANG SUTORO, KOMPLEK TNI AL',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 74.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SIDOTOPO WETAN',
            'alamat' => 'JL SIDOTOPO WETAN I LUAR NO 1',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 132.62,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SIDOTOPO WETAN 2',
            'alamat' => 'JL SIDOTOPO WETAN I LUAR NO 1',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 96.28,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 58',
            'alamat' => 'PLATUK DONOMULYO NO 74',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 100.05,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SIDOTOPO WETAN 5',
            'alamat' => 'PLATUK DONOMULYO NO. 74',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 167.4,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SIDOTOPO WETAN 4',
            'alamat' => 'RANDU NO 100',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 541.2,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN SIDOTOPO WETAN 1',
            'alamat' => 'SIDOTOPO WETAN I LUAR NO. 01',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 101.39,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 15',
            'alamat' => 'H. MOH. NOER NO 352',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 93.9,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN TANAH KALIKEDINDING 5',
            'alamat' => 'KALI KEDINDING V/ 579',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 129.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 60',
            'alamat' => 'KALILOM LOR INDAH',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 70.67,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN TANAH KALIKEDINDING 1',
            'alamat' => 'KALILOM LOR INDAH I NO 1­3',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 145.5,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN KEDUNG COWEK 1',
            'alamat' => 'KEDUNG COWEK',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 165.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN DUPAK 1',
            'alamat' => 'ALUN­ ALUN BANGUNSARI BARAT NO 2',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 122.85,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMAK STELLA MARIS',
            'alamat' => 'INDRAPURA NO 32',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 103.37,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMP KAWUNG 1',
            'alamat' => 'PARANG KUSUMO NO 2',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 168.95,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 5',
            'alamat' => 'RAJAWALI NO 57',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 109.77,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN MOROKREMBANGAN 1',
            'alamat' => 'GRESIK NO 160',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 92.53,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMP MUJAHIDIN',
            'alamat' => 'JL PERAK BARAT',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 136.54,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMP BARUNAWATI',
            'alamat' => 'PERAK BARAT',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 70.67,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 7',
            'alamat' => 'TANJUNG SADARI NO 17',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 108.68,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SMPN 8',
            'alamat' => 'BUNGURAN NO. 15-17',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 126.39,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN UJUNG 9',
            'alamat' => 'JL SEMAMPIR',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 600.564,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'SDN WONOKUSUMO 5',
            'alamat' => 'WONOKUSUMO LOR NO. 44',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 158.56,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'REKOSISTEM SURABAYA',
            'alamat' => 'CLUe GREEN HILL CITRALAND',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 180.55,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'RSUD BHAKTI DHARMA HUSADA',
            'alamat' => 'JALAN RAYA KENDUNG NOMOR 115 SAMPAI 117',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 134.02,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PT. INS GENERAL INDONESIA',
            'alamat' => 'KOMP. PERGUDANGAN OSOWILANGON PERMAI B-19',
            'wilayah' => 'BARAT',
            'tonase_kg_bulan' => 180.78,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP BG JUNCTION',
            'alamat' => 'BUBUTAN NO. 01-07',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 350.48,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PT. ICE CREAM ESKIMO',
            'alamat' => 'EMBONG TANJUNG NO. 04',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 357.09,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'IIK PERHUTANI JAWA TIMUR',
            'alamat' => 'GENTENG KALI NO. 49',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 406.06,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP GALAXY MALL',
            'alamat' => 'DHARMAHUSADA INDAH TIMUR NO. 14',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 300.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP GRAND CITY',
            'alamat' => 'WALIKOTA MUSTAJAB NO. 01',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 230.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'KARAOKE SUKA-SUKA KAZA CITY',
            'alamat' => 'KAPAS KRAMPUNG',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 326.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PT. KIMIA FARMA DIAGNOSTIKA - DARMO',
            'alamat' => 'RAYA DARMO NO. 06',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 502.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP TUNJUNGAN PLAZA 3',
            'alamat' => 'BASUKI RAHMAT NO. 08-12',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 109.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP TUNJUNGAN PLAZA 4',
            'alamat' => 'BASUKI RAHMAT NO. 08-12',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 253.76,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GERAKAN PUNGUT SAMPAH',
            'alamat' => 'TUMAPEL NO. 41',
            'wilayah' => 'PUSAT',
            'tonase_kg_bulan' => 150.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PRO EARTH INDONESIA',
            'alamat' => 'DUKUH KUPANG XVII/12',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 300.89,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP CIPUTRA WORLD',
            'alamat' => 'MAYJEN SUNGKONO NO. 89',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 230.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'TUNAS HIJAU INDONESIA',
            'alamat' => 'KETINTANG TIMUR PTT II/22',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 326.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP PAKUWON',
            'alamat' => 'MAYJEN YONO SUWOYO NO. 02 (PAKUWON MALL LEVEL LG)',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 502.45,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PT. GRAHA DAMAI SEJAHTERA',
            'alamat' => 'DIPONEGORO NO. 33',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 230.98,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'THE BODY SHOP ROYAL PLAZA',
            'alamat' => 'FRONTAGE SISI BARAT AHMAD YANI',
            'wilayah' => 'SELATAN',
            'tonase_kg_bulan' => 326.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PAWONJANI',
            'alamat' => 'GUNUNG ANYAR LOR II/98',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 326.88,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'ALANG-ALANG ZERO WASTE',
            'alamat' => 'Dr. Ir. H. SOEKARNO',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 203.04,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'FIF CABANG SURABAYA 2',
            'alamat' => 'MANYAR REJO NO. 7',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 455.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'GARDA PANGAN',
            'alamat' => 'SUKO SEMOLO II BLOK J-04',
            'wilayah' => 'TIMUR',
            'tonase_kg_bulan' => 200.0,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'OTORITAS JASA KEUANGAN KANTOR REGIONAL 4',
            'alamat' => 'KREMBANGAN',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 573.23,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $data_bank[] = [
            'nama_bank_sampah' => 'PT. SAMUDRAYUANA ANJATRANS',
            'alamat' => 'TELUK ARU TENGAH NO. 01',
            'wilayah' => 'UTARA',
            'tonase_kg_bulan' => 123.86,
            'created_at' => now(),
            'updated_at' => now()
        ];
        // Lokasi: SUPER DEPO SUTOREJO
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 9.89 * (rand(90, 110) / 100);
            $organik = 3.58 * (rand(90, 110) / 100);
            $residu = 4.94 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'SUPER DEPO SUTOREJO',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: PDU JAMBANGAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 6.32 * (rand(90, 110) / 100);
            $organik = 2.13 * (rand(90, 110) / 100);
            $residu = 3.37 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'PDU JAMBANGAN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: PEMILAHAN BRATANG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.71 * (rand(90, 110) / 100);
            $organik = 0.78 * (rand(90, 110) / 100);
            $residu = 0.9 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'PEMILAHAN BRATANG',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R TAMBAK OSOWILANGUN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 8.17 * (rand(90, 110) / 100);
            $organik = 3.37 * (rand(90, 110) / 100);
            $residu = 2.7 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R TAMBAK OSOWILANGUN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R TENGGILIS
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 5.4 * (rand(90, 110) / 100);
            $organik = 1.25 * (rand(90, 110) / 100);
            $residu = 3.28 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R TENGGILIS',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R KEDUNG COWEK
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.74 * (rand(90, 110) / 100);
            $organik = 1.3 * (rand(90, 110) / 100);
            $residu = 2.46 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R KEDUNG COWEK',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R GUNUNG ANYAR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.78 * (rand(90, 110) / 100);
            $organik = 1.61 * (rand(90, 110) / 100);
            $residu = 2.48 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R GUNUNG ANYAR',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R KARANG PILANG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 3.62 * (rand(90, 110) / 100);
            $organik = 1.73 * (rand(90, 110) / 100);
            $residu = 1.58 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R KARANG PILANG',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R WARU GUNUNG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.78 * (rand(90, 110) / 100);
            $organik = 1.94 * (rand(90, 110) / 100);
            $residu = 2.38 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R WARU GUNUNG',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R BANJARSUGIHAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 6.01 * (rand(90, 110) / 100);
            $organik = 1.31 * (rand(90, 110) / 100);
            $residu = 3.21 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R BANJARSUGIHAN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R TAMBAK WEDI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 8.39 * (rand(90, 110) / 100);
            $organik = 1.09 * (rand(90, 110) / 100);
            $residu = 6.51 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R TAMBAK WEDI',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TPS3R SUMBER REJO
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 9.2 * (rand(90, 110) / 100);
            $organik = 2.55 * (rand(90, 110) / 100);
            $residu = 4.84 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TPS3R SUMBER REJO',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: L O K A S I
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2025.0 * (rand(90, 110) / 100);
            $organik = 0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'L O K A S I',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: MENUR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.44 * (rand(90, 110) / 100);
            $organik = 1.3 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'MENUR',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: KEPUTRAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 6.59 * (rand(90, 110) / 100);
            $organik = 0.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'KEPUTRAN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: BRATANG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 5.62 * (rand(90, 110) / 100);
            $organik = 1.49 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'BRATANG',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: KAYOON
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.36 * (rand(90, 110) / 100);
            $organik = 0.23 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'KAYOON',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: LIPONSOS KEPUTIH
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 0.0 * (rand(90, 110) / 100);
            $organik = 0.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'LIPONSOS KEPUTIH',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: WONOREJO I
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 0.04 * (rand(90, 110) / 100);
            $organik = 0.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'WONOREJO I',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: RUNGKUT ASRI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.11 * (rand(90, 110) / 100);
            $organik = 1.33 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'RUNGKUT ASRI',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TENGGILIS UTARA
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2.83 * (rand(90, 110) / 100);
            $organik = 0.87 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TENGGILIS UTARA',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TENGGILIS
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.21 * (rand(90, 110) / 100);
            $organik = 0.93 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TENGGILIS',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: GAYUNGSARI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.79 * (rand(90, 110) / 100);
            $organik = 0.52 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'GAYUNGSARI',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: BIBIS KARAH
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.34 * (rand(90, 110) / 100);
            $organik = 0.39 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'BIBIS KARAH',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: JAMBANGAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 6.18 * (rand(90, 110) / 100);
            $organik = 1.27 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'JAMBANGAN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: BALAS KLUMPRIK
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.81 * (rand(90, 110) / 100);
            $organik = 0.57 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'BALAS KLUMPRIK',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: GUNUNGSARI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.78 * (rand(90, 110) / 100);
            $organik = 0.53 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'GUNUNGSARI',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: PUTAT JAYA
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 0.54 * (rand(90, 110) / 100);
            $organik = 0.15 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'PUTAT JAYA',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: SONOKWIJENAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 3.11 * (rand(90, 110) / 100);
            $organik = 0.96 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'SONOKWIJENAN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TUBANAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 0.3 * (rand(90, 110) / 100);
            $organik = 0.07 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TUBANAN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: RUNGKUT MERR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 4.75 * (rand(90, 110) / 100);
            $organik = 1.54 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'RUNGKUT MERR',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: IPLT KEPUTIH
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2.33 * (rand(90, 110) / 100);
            $organik = 0.74 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'IPLT KEPUTIH',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: BABAT JERAWAT
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2.4 * (rand(90, 110) / 100);
            $organik = 0.74 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'BABAT JERAWAT',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: MEDOKAN AYU
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2.93 * (rand(90, 110) / 100);
            $organik = 0.93 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'MEDOKAN AYU',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: JANGKAR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 3.37 * (rand(90, 110) / 100);
            $organik = 1.1 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'JANGKAR',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: KYAI TAMBAK DERES
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 0.0 * (rand(90, 110) / 100);
            $organik = 0.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'KYAI TAMBAK DERES',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: WONOREJO II
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 27.35 * (rand(90, 110) / 100);
            $organik = 4.87 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'WONOREJO II',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: TAMBAK WEDI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2.46 * (rand(90, 110) / 100);
            $organik = 0.78 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'TAMBAK WEDI',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: MBAH RATU
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 1.27 * (rand(90, 110) / 100);
            $organik = 0.39 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'MBAH RATU',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lokasi: NGINDEN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 365; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Randomize sedikit biar natural (+- 10%)
            $masuk = 2.1 * (rand(90, 110) / 100);
            $organik = 0.64 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);

            $data_tps3r[] = [
                'lokasi' => 'NGINDEN',
                'tanggal' => $tgl,
                'sampah_masuk_ton_hari' => $masuk,
                'organik_ton_hari' => $organik,
                'residu_ton_hari' => $residu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $data_armada[] = ['jenis_kendaraan' => 'Dump Truk', 'jumlah_unit' => 28.0, 'satuan' => 'Unit', 'created_at' => now()];
        $data_armada[] = ['jenis_kendaraan' => 'Arm Roll Truck ', 'jumlah_unit' => 46.0, 'satuan' => 'Unit', 'created_at' => now()];
        $data_armada[] = ['jenis_kendaraan' => 'Compactor', 'jumlah_unit' => 81.0, 'satuan' => 'Unit', 'created_at' => now()];
        $data_armada[] = ['jenis_kendaraan' => 'Road Sweeper', 'jumlah_unit' => 5.0, 'satuan' => 'Unit', 'created_at' => now()];
        
        $data_tpa[] = ['tahun' => 2025, 'total_tonase' => 592029.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2024, 'total_tonase' => 560060.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2023, 'total_tonase' => 561076.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2022, 'total_tonase' => 585856.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2021, 'total_tonase' => 580409.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2020, 'total_tonase' => 605610.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2019, 'total_tonase' => 618404.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2018, 'total_tonase' => 616617.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2017, 'total_tonase' => 602434.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2016, 'total_tonase' => 667610.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2015, 'total_tonase' => 472746.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2014, 'total_tonase' => 480364.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2013, 'total_tonase' => 467256.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2012, 'total_tonase' => 82781.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R SUMBEREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'SUPER DEPO SUTOREJO', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PDU JAMBANGAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'PEMILAHAN BRATANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAK OSOWILANGUN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TENGGILIS', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KEDUNG COWEK', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R GUNUNG ANYAR', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R KARANG PILANG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R WARU GUNUNG', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R BANJAR SUGIHAN', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        $data_b3[] = ['nama_lokasi' => 'TPS3R TAMBAKWEDI', 'jenis_limbah' => 'Campuran', 'berat_kg' => 0, 'created_at' => now()];
        // INSERT IN CHUNKS
        foreach (array_chunk($data_fasilitas, 500) as $chunk) {
            DB::table('master_fasilitas_rinci')->insert($chunk);
        }
        foreach (array_chunk($data_bank, 500) as $chunk) {
            DB::table('master_bank_sampah')->insert($chunk);
        }
        foreach (array_chunk($data_armada, 500) as $chunk) {
            DB::table('master_armada')->insert($chunk);
        }
        foreach (array_chunk($data_bbm, 500) as $chunk) {
            DB::table('laporan_bbm')->insert($chunk);
        }
        foreach (array_chunk($data_tpa, 500) as $chunk) {
            DB::table('laporan_tpa_rekap')->insert($chunk);
        }
        foreach (array_chunk($data_b3, 500) as $chunk) {
            DB::table('laporan_b3_rt')->insert($chunk);
        }

        // TPS3R is huge, chunk 1000
        foreach (array_chunk($data_tps3r, 1000) as $chunk) {
            DB::table('laporan_tps3r_harian')->insert($chunk);
        }
    }
}
