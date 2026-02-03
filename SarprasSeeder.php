<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SarprasSeeder extends Seeder {
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tables = ['master_fasilitas_rinci', 'master_bank_sampah', 'laporan_tps3r_harian', 
                   'laporan_b3_rt', 'master_armada', 'laporan_bbm', 'laporan_tpa_rekap'];
        foreach($tables as $tbl) { DB::table($tbl)->truncate(); }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $data_fasilitas = []; $data_bank = []; $data_tps3r = []; 
        $data_b3 = []; $data_armada = []; $data_bbm = []; $data_tpa = [];

        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kalibutuh", 'timbulan_sampah_masuk_kg' => 145080.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pirngadi", 'timbulan_sampah_masuk_kg' => 121640.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Penghela", 'timbulan_sampah_masuk_kg' => 229720.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sulung", 'timbulan_sampah_masuk_kg' => 187300.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Dupak Prau", 'timbulan_sampah_masuk_kg' => 153550.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Simolawang", 'timbulan_sampah_masuk_kg' => 368690.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Kapasan", 'timbulan_sampah_masuk_kg' => 81940.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tambak Rejo", 'timbulan_sampah_masuk_kg' => 1580070.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Simpang Dukuh", 'timbulan_sampah_masuk_kg' => 66160.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Genteng", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kayon", 'timbulan_sampah_masuk_kg' => 327530.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Legundi Anggrek", 'timbulan_sampah_masuk_kg' => 357350.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Makam Peneleh", 'timbulan_sampah_masuk_kg' => 230790.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kedondong", 'timbulan_sampah_masuk_kg' => 361900.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kedung Anyar", 'timbulan_sampah_masuk_kg' => 381530.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Kembang", 'timbulan_sampah_masuk_kg' => 185540.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Dinoyo", 'timbulan_sampah_masuk_kg' => 170870.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Taman Ketampon", 'timbulan_sampah_masuk_kg' => 412980.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Keputran Utara II", 'timbulan_sampah_masuk_kg' => 117040.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tubanan", 'timbulan_sampah_masuk_kg' => 410360.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Karang Poh", 'timbulan_sampah_masuk_kg' => 156840.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Balongsari", 'timbulan_sampah_masuk_kg' => 96880.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Manukan Wetan", 'timbulan_sampah_masuk_kg' => 75430.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Manukan Kulon", 'timbulan_sampah_masuk_kg' => 378600.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Manukan Kulon Baru", 'timbulan_sampah_masuk_kg' => 19920.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Manukan Telaga", 'timbulan_sampah_masuk_kg' => 76610.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Buntaran", 'timbulan_sampah_masuk_kg' => 14610.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Darmo indah", 'timbulan_sampah_masuk_kg' => 82100.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Griya Citra Asri", 'timbulan_sampah_masuk_kg' => 1210.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tengger Kandangan", 'timbulan_sampah_masuk_kg' => 87840.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kandangan", 'timbulan_sampah_masuk_kg' => 8020.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Klakah Rejo", 'timbulan_sampah_masuk_kg' => 69840.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kendung Makam", 'timbulan_sampah_masuk_kg' => 21990.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kendung BDH", 'timbulan_sampah_masuk_kg' => 48110.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Sememi", 'timbulan_sampah_masuk_kg' => 116810.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Romo Kalisari", 'timbulan_sampah_masuk_kg' => 14750.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Rusun Romokalisari", 'timbulan_sampah_masuk_kg' => 31950.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Babat Jerawat", 'timbulan_sampah_masuk_kg' => 63590.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Langkir", 'timbulan_sampah_masuk_kg' => 16630.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "PBI", 'timbulan_sampah_masuk_kg' => 201250.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Benowo", 'timbulan_sampah_masuk_kg' => 54280.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Benowo Krajan", 'timbulan_sampah_masuk_kg' => 13060.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jurang Kuping", 'timbulan_sampah_masuk_kg' => 18160.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sumberejo", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Krenuk", 'timbulan_sampah_masuk_kg' => 33910.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pakal Sidorejo", 'timbulan_sampah_masuk_kg' => 8560.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pakal madya", 'timbulan_sampah_masuk_kg' => 118060.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Lempung Perdana", 'timbulan_sampah_masuk_kg' => 78740.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Candi Lontar", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sawo Bringin", 'timbulan_sampah_masuk_kg' => 41700.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bringin", 'timbulan_sampah_masuk_kg' => 15730.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Alas Malang", 'timbulan_sampah_masuk_kg' => 27130.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kuwukan", 'timbulan_sampah_masuk_kg' => 270440.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Lakar Santri", 'timbulan_sampah_masuk_kg' => 84570.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Wisma Lidah Kulon", 'timbulan_sampah_masuk_kg' => 34030.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Puri Lidah Kulon", 'timbulan_sampah_masuk_kg' => 87630.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "UNESA", 'timbulan_sampah_masuk_kg' => 10360.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bangkingan Aspol", 'timbulan_sampah_masuk_kg' => 7340.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bangkingan", 'timbulan_sampah_masuk_kg' => 85450.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sukomanunggal", 'timbulan_sampah_masuk_kg' => 185960.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Simohilir", 'timbulan_sampah_masuk_kg' => 147560.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Simorukun", 'timbulan_sampah_masuk_kg' => 544940.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Putat Gede", 'timbulan_sampah_masuk_kg' => 364350.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sonokwijenan", 'timbulan_sampah_masuk_kg' => 39250.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Asemrowo", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jayamix", 'timbulan_sampah_masuk_kg' => 305040.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Genting", 'timbulan_sampah_masuk_kg' => 68580.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jl.Greges", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bintang Diponggo", 'timbulan_sampah_masuk_kg' => 311390.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Dupak Bandarejo", 'timbulan_sampah_masuk_kg' => 93450.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Dupak Bangunsari", 'timbulan_sampah_masuk_kg' => 240010.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Mbah Ratu", 'timbulan_sampah_masuk_kg' => 286810.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Asrama Brimob PPI", 'timbulan_sampah_masuk_kg' => 17940.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tambak Asri", 'timbulan_sampah_masuk_kg' => 285260.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tanjung Sadari", 'timbulan_sampah_masuk_kg' => 168910.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Krembangan Barat", 'timbulan_sampah_masuk_kg' => 329230.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Morokrembangan", 'timbulan_sampah_masuk_kg' => 27800.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Wonokusumo Kidul", 'timbulan_sampah_masuk_kg' => 468620.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jl.Pegirian", 'timbulan_sampah_masuk_kg' => 71430.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Benteng", 'timbulan_sampah_masuk_kg' => 742890.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kertopaten", 'timbulan_sampah_masuk_kg' => 487310.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "THP Kenjeran", 'timbulan_sampah_masuk_kg' => 65730.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jati Srono", 'timbulan_sampah_masuk_kg' => 86310.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jati Purwo", 'timbulan_sampah_masuk_kg' => 88660.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Mrutu Kalianyar II", 'timbulan_sampah_masuk_kg' => 155060.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pesapen Pompa", 'timbulan_sampah_masuk_kg' => 29510.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Baba'an", 'timbulan_sampah_masuk_kg' => 137460.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Indrapura PLN", 'timbulan_sampah_masuk_kg' => 152430.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jl.Semut Kali", 'timbulan_sampah_masuk_kg' => 87180.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tambak Deres", 'timbulan_sampah_masuk_kg' => 312260.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Memet", 'timbulan_sampah_masuk_kg' => 71130.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Platuk Donomulyo", 'timbulan_sampah_masuk_kg' => 408040.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sidotopo Wetan", 'timbulan_sampah_masuk_kg' => 355600.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Podomoro", 'timbulan_sampah_masuk_kg' => 205790.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bulak Banteng Bandarejo", 'timbulan_sampah_masuk_kg' => 19070.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bulak Banteng Timur", 'timbulan_sampah_masuk_kg' => 142390.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bulak Banteng II", 'timbulan_sampah_masuk_kg' => 353020.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kali Kedinding", 'timbulan_sampah_masuk_kg' => 462940.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tambak Wedi", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Gubeng Masjid", 'timbulan_sampah_masuk_kg' => 55270.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Gubeng Masjid", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Candi Puro", 'timbulan_sampah_masuk_kg' => 488000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Pacar Keling", 'timbulan_sampah_masuk_kg' => 133170.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Petojo", 'timbulan_sampah_masuk_kg' => 73150.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kaliwaron II", 'timbulan_sampah_masuk_kg' => 361760.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Mojoarum", 'timbulan_sampah_masuk_kg' => 488010.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Srikana", 'timbulan_sampah_masuk_kg' => 755860.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kangean", 'timbulan_sampah_masuk_kg' => 242960.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Pucang", 'timbulan_sampah_masuk_kg' => 112590.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kalibokor", 'timbulan_sampah_masuk_kg' => 266410.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bratang", 'timbulan_sampah_masuk_kg' => 655370.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ngagel Dadi", 'timbulan_sampah_masuk_kg' => 344490.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bratang Lapangan", 'timbulan_sampah_masuk_kg' => 191320.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Barata Jaya", 'timbulan_sampah_masuk_kg' => 91050.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Buktong", 'timbulan_sampah_masuk_kg' => 426370.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "ITS", 'timbulan_sampah_masuk_kg' => 318940.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "IPLT Keputih", 'timbulan_sampah_masuk_kg' => 344260.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Gebang Keputih", 'timbulan_sampah_masuk_kg' => 242100.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Klampis", 'timbulan_sampah_masuk_kg' => 215830.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Semolowaru", 'timbulan_sampah_masuk_kg' => 340820.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Semolowaru Bahari", 'timbulan_sampah_masuk_kg' => 121910.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Medokan Semampir", 'timbulan_sampah_masuk_kg' => 233610.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Asrama Brimob Nginden", 'timbulan_sampah_masuk_kg' => 3030.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kejawen Putih", 'timbulan_sampah_masuk_kg' => 269790.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Rungkut Alang alang", 'timbulan_sampah_masuk_kg' => 424600.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Rungkut Kidul II", 'timbulan_sampah_masuk_kg' => 472030.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kendal Sari", 'timbulan_sampah_masuk_kg' => 280060.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Penjaringan Sari", 'timbulan_sampah_masuk_kg' => 457260.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Medokan Ayu II", 'timbulan_sampah_masuk_kg' => 475340.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Wonorejo", 'timbulan_sampah_masuk_kg' => 149550.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Rungkut Asri", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Rungkut Menanggal", 'timbulan_sampah_masuk_kg' => 331510.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Metro", 'timbulan_sampah_masuk_kg' => 170100.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Wiguna Timur", 'timbulan_sampah_masuk_kg' => 183270.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bogen Tambaksari", 'timbulan_sampah_masuk_kg' => 432810.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Purimas", 'timbulan_sampah_masuk_kg' => 144990.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tenggilis Mejoyo", 'timbulan_sampah_masuk_kg' => 152950.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Tenggilis Utara", 'timbulan_sampah_masuk_kg' => 402500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kendangsari", 'timbulan_sampah_masuk_kg' => 567260.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kutisari PLN II", 'timbulan_sampah_masuk_kg' => 251260.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Siwalankerto Landasan", 'timbulan_sampah_masuk_kg' => 393110.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jemur Wonosari", 'timbulan_sampah_masuk_kg' => 472320.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Wisma Permai II", 'timbulan_sampah_masuk_kg' => 104420.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Sutorejo", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kalijudan", 'timbulan_sampah_masuk_kg' => 229590.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bukit Barisan", 'timbulan_sampah_masuk_kg' => 473040.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Petemon Kuburan", 'timbulan_sampah_masuk_kg' => 66280.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kembang Kuning", 'timbulan_sampah_masuk_kg' => 661730.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Simo Katrungan", 'timbulan_sampah_masuk_kg' => 79890.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Mataram utara", 'timbulan_sampah_masuk_kg' => 694430.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Makam Mataram II", 'timbulan_sampah_masuk_kg' => 597410.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Joyoboyo", 'timbulan_sampah_masuk_kg' => 378230.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Wonoboyo", 'timbulan_sampah_masuk_kg' => 42440.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bukit Mas", 'timbulan_sampah_masuk_kg' => 27800.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pradah Kali Kendal", 'timbulan_sampah_masuk_kg' => 110670.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jl.Jetis Kulon", 'timbulan_sampah_masuk_kg' => 543720.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ngagel", 'timbulan_sampah_masuk_kg' => 127310.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Beras Bendul Merisi II", 'timbulan_sampah_masuk_kg' => 246110.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jagir", 'timbulan_sampah_masuk_kg' => 72310.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bosem Morokrembangan", 'timbulan_sampah_masuk_kg' => 11100.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bendul Merisi", 'timbulan_sampah_masuk_kg' => 247540.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Prapen DKK", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.kedurus", 'timbulan_sampah_masuk_kg' => 159800.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kemlaten", 'timbulan_sampah_masuk_kg' => 55100.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Bogangin", 'timbulan_sampah_masuk_kg' => 125910.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kebraon II", 'timbulan_sampah_masuk_kg' => 276970.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Rusun Waru gunung", 'timbulan_sampah_masuk_kg' => 36020.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ketintang Baru Selatan", 'timbulan_sampah_masuk_kg' => 387200.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Gayung Sari", 'timbulan_sampah_masuk_kg' => 145970.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Gayung Pring", 'timbulan_sampah_masuk_kg' => 171440.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Gayung Kebonsari", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Menanggal", 'timbulan_sampah_masuk_kg' => 300640.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Dukuh Menanggal", 'timbulan_sampah_masuk_kg' => 145730.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kalianak", 'timbulan_sampah_masuk_kg' => 19450.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Karah", 'timbulan_sampah_masuk_kg' => 173610.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Prapen", 'timbulan_sampah_masuk_kg' => 156080.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jambangan", 'timbulan_sampah_masuk_kg' => 183870.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pagesangan", 'timbulan_sampah_masuk_kg' => 418660.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Kebonsari Makam", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Ps.Wiyung", 'timbulan_sampah_masuk_kg' => 258380.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Babatan Pratama", 'timbulan_sampah_masuk_kg' => 135070.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pondok Indah Wiyung", 'timbulan_sampah_masuk_kg' => 36010.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "TPI Wiyung", 'timbulan_sampah_masuk_kg' => 33080.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jajar Tunggal II", 'timbulan_sampah_masuk_kg' => 113410.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Pondok Manggala", 'timbulan_sampah_masuk_kg' => 12670.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Balas Klumprik", 'timbulan_sampah_masuk_kg' => 156060.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Karang Pilang II", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jeruk", 'timbulan_sampah_masuk_kg' => 5230.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Yani Golf", 'timbulan_sampah_masuk_kg' => 31530.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Tempat Penampungan Sementara", 'nama_fasilitas' => "Jogoloyo", 'timbulan_sampah_masuk_kg' => 85670.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Menur", 'timbulan_sampah_masuk_kg' => 102500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Keputran", 'timbulan_sampah_masuk_kg' => 179250.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Bratang", 'timbulan_sampah_masuk_kg' => 142000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Kayoon", 'timbulan_sampah_masuk_kg' => 36250.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Liponsos Keputih 2", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Wonorejo I", 'timbulan_sampah_masuk_kg' => 750.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Rungkut Asri", 'timbulan_sampah_masuk_kg' => 96500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Tenggilis Utara", 'timbulan_sampah_masuk_kg' => 63000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Tenggilis", 'timbulan_sampah_masuk_kg' => 119000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Gayungsari", 'timbulan_sampah_masuk_kg' => 37100.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Bibis Karah", 'timbulan_sampah_masuk_kg' => 29000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Jambangan", 'timbulan_sampah_masuk_kg' => 162750.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Balas Klumprik", 'timbulan_sampah_masuk_kg' => 32750.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Gunungsari", 'timbulan_sampah_masuk_kg' => 38500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Putat Jaya", 'timbulan_sampah_masuk_kg' => 19000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Sonokwijenan", 'timbulan_sampah_masuk_kg' => 77500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Tubanan", 'timbulan_sampah_masuk_kg' => 13250.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Rungkut Merr", 'timbulan_sampah_masuk_kg' => 114500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Iplc Keputih", 'timbulan_sampah_masuk_kg' => 47500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Babat Jerawat", 'timbulan_sampah_masuk_kg' => 39500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Medokan Ayu", 'timbulan_sampah_masuk_kg' => 63500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Jangkar", 'timbulan_sampah_masuk_kg' => 55000.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Kyai Tambak Deres", 'timbulan_sampah_masuk_kg' => 0.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Wonorejo Ii", 'timbulan_sampah_masuk_kg' => 586750.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Tambak Wedi", 'timbulan_sampah_masuk_kg' => 57500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Mbah Ratu", 'timbulan_sampah_masuk_kg' => 28500.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "Rumah Kompos", 'nama_fasilitas' => "Rumah Kompos Nginden Jangkungan", 'timbulan_sampah_masuk_kg' => 43750.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "Super Depo Sutorejo", 'timbulan_sampah_masuk_kg' => 287561.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "PDU Jambangan", 'timbulan_sampah_masuk_kg' => 194920.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Tambak Osowilangun", 'timbulan_sampah_masuk_kg' => 242162.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Tenggilis", 'timbulan_sampah_masuk_kg' => 168790.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Kedung Cowek", 'timbulan_sampah_masuk_kg' => 131710.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Gunung Anyar", 'timbulan_sampah_masuk_kg' => 155890.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Karang Pilang", 'timbulan_sampah_masuk_kg' => 110850.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Warugunung", 'timbulan_sampah_masuk_kg' => 161790.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Banjarsugihan", 'timbulan_sampah_masuk_kg' => 178455.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "Pemilahan Bratang", 'timbulan_sampah_masuk_kg' => 53640.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPA", 'nama_fasilitas' => "TPA Benowo", 'timbulan_sampah_masuk_kg' => 48165680.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Tambakwedi", 'timbulan_sampah_masuk_kg' => 295520.0, 'created_at' => now()];
        $data_fasilitas[] = ['jenis_fasilitas' => "TPS3R", 'nama_fasilitas' => "TPS 3R Sumberejo", 'timbulan_sampah_masuk_kg' => 256790.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKAR WANGI", 'tonase_kg_bulan' => 423.12, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BRANJANGAN", 'tonase_kg_bulan' => 145.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BUYUK MANDIRI", 'tonase_kg_bulan' => 210.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KHARISMA MANDIRI", 'tonase_kg_bulan' => 101.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ASAPAT", 'tonase_kg_bulan' => 241.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERSERI", 'tonase_kg_bulan' => 406.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAHLIA", 'tonase_kg_bulan' => 213.61, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN", 'tonase_kg_bulan' => 380.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KENCUR", 'tonase_kg_bulan' => 266.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MATAHARI", 'tonase_kg_bulan' => 190.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANDAN WANGI", 'tonase_kg_bulan' => 467.35, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN SEJAHTERA", 'tonase_kg_bulan' => 296.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAKINAH", 'tonase_kg_bulan' => 145.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAKURA", 'tonase_kg_bulan' => 318.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRIKANDI RT 2", 'tonase_kg_bulan' => 421.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMU KUNCI", 'tonase_kg_bulan' => 420.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH ILAHI", 'tonase_kg_bulan' => 288.35, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ROMO BERKARYA", 'tonase_kg_bulan' => 464.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KALINGGA", 'tonase_kg_bulan' => 346.46, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MENTARI", 'tonase_kg_bulan' => 331.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI ENAM BERSERI", 'tonase_kg_bulan' => 269.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA", 'tonase_kg_bulan' => 300.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA BERIMAN", 'tonase_kg_bulan' => 235.58, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA BERSERI", 'tonase_kg_bulan' => 368.08, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA CANTIK", 'tonase_kg_bulan' => 438.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA CERIA", 'tonase_kg_bulan' => 254.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA SAKINAH", 'tonase_kg_bulan' => 388.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMEMI JAYA SEJAHTERA", 'tonase_kg_bulan' => 210.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH JAYA", 'tonase_kg_bulan' => 274.52, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KAUMAN BERSERI", 'tonase_kg_bulan' => 181.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CITRA SUMBER REJEKI", 'tonase_kg_bulan' => 407.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LUMINTU CERIA", 'tonase_kg_bulan' => 247.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAKURA DELAPAN", 'tonase_kg_bulan' => 286.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LESTARI", 'tonase_kg_bulan' => 117.74, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI 1", 'tonase_kg_bulan' => 155.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAROKAH", 'tonase_kg_bulan' => 358.12, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER REJEKI", 'tonase_kg_bulan' => 258.95, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LIDAH HARAPAN 2", 'tonase_kg_bulan' => 244.48, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LIDAH HARAPAN 3", 'tonase_kg_bulan' => 245.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PEDULI LINGKUNGAN", 'tonase_kg_bulan' => 171.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MITRA RESIK", 'tonase_kg_bulan' => 244.36, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MUGI BERKAH", 'tonase_kg_bulan' => 252.08, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ADI GUNA 7", 'tonase_kg_bulan' => 225.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ADI GUNA 9", 'tonase_kg_bulan' => 116.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "AN-NAHL", 'tonase_kg_bulan' => 107.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARTA GUNA 8", 'tonase_kg_bulan' => 243.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH", 'tonase_kg_bulan' => 450.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BJA MAKMUR", 'tonase_kg_bulan' => 219.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAHLIA", 'tonase_kg_bulan' => 145.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAHLIA JAYA", 'tonase_kg_bulan' => 114.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ERTIGA", 'tonase_kg_bulan' => 104.52, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GEMAH RIPAH", 'tonase_kg_bulan' => 103.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GRIYA 6", 'tonase_kg_bulan' => 120.2, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GRIYA BERSIH 5", 'tonase_kg_bulan' => 250.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GRIYA BERSIH MELATI 1", 'tonase_kg_bulan' => 206.67, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LANCAR JAYA", 'tonase_kg_bulan' => 300.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN AGAWE SANTOSO", 'tonase_kg_bulan' => 98.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRI REJEKI", 'tonase_kg_bulan' => 132.04, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER REJEKI", 'tonase_kg_bulan' => 335.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERINGIN BERSERI", 'tonase_kg_bulan' => 250.73, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANUGERAH", 'tonase_kg_bulan' => 115.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LONTAR MANDIRI", 'tonase_kg_bulan' => 119.81, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU JAYA", 'tonase_kg_bulan' => 144.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU SEJAHTERA", 'tonase_kg_bulan' => 190.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PKK RT 11", 'tonase_kg_bulan' => 300.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SWASEMBADA", 'tonase_kg_bulan' => 123.22, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKARSARI", 'tonase_kg_bulan' => 111.57, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PIN PIN 07", 'tonase_kg_bulan' => 136.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBI RT 8", 'tonase_kg_bulan' => 87.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ASOKA MANDIRI", 'tonase_kg_bulan' => 287.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CAHAYA ASA", 'tonase_kg_bulan' => 99.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PRIMA", 'tonase_kg_bulan' => 98.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SIMPONI", 'tonase_kg_bulan' => 106.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SURYA MANDIRI SEJAHTERA", 'tonase_kg_bulan' => 143.27, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARJUNA MANDIRI", 'tonase_kg_bulan' => 188.12, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARYA MULYA", 'tonase_kg_bulan' => 257.42, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WARTUN SEJAHTERA", 'tonase_kg_bulan' => 300.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH SUKOMANUNGGAL", 'tonase_kg_bulan' => 183.43, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TANJUNG CERIA", 'tonase_kg_bulan' => 172.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TANJUNGSARI BAHAGIA", 'tonase_kg_bulan' => 244.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANGGREK", 'tonase_kg_bulan' => 215.57, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HIJAU MANDIRI", 'tonase_kg_bulan' => 372.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ERMA SEJAHTERA", 'tonase_kg_bulan' => 175.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BANGYOS", 'tonase_kg_bulan' => 244.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BANK INFAQ SAMPAH AL-MUHAJIRIN (BISA)", 'tonase_kg_bulan' => 183.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERSIMPATIK", 'tonase_kg_bulan' => 396.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKSIMA", 'tonase_kg_bulan' => 293.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANUKAN GUYUB RUKUN", 'tonase_kg_bulan' => 389.79, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MUKTI JAYA", 'tonase_kg_bulan' => 288.26, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "REJO BERKAH", 'tonase_kg_bulan' => 303.42, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRI LESTARI", 'tonase_kg_bulan' => 139.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMANGGUNGAN", 'tonase_kg_bulan' => 104.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUNDIH", 'tonase_kg_bulan' => 303.97, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU SEJAHTERA", 'tonase_kg_bulan' => 254.27, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANGGIS", 'tonase_kg_bulan' => 439.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MARGODADI", 'tonase_kg_bulan' => 301.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PRATAMA UNGGUL", 'tonase_kg_bulan' => 162.85, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RESIK MANDIRI", 'tonase_kg_bulan' => 500.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN JAYA", 'tonase_kg_bulan' => 271.6, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBERNYAWA", 'tonase_kg_bulan' => 406.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TANJUNG SEJAHTERA", 'tonase_kg_bulan' => 112.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "AL HIKMA", 'tonase_kg_bulan' => 230.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARTO MORO", 'tonase_kg_bulan' => 100.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB KERTORAHARJO", 'tonase_kg_bulan' => 237.41, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KOWANDULLING", 'tonase_kg_bulan' => 366.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER BAROKAH", 'tonase_kg_bulan' => 601.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TULIP", 'tonase_kg_bulan' => 121.48, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ASEM JAJAR RT 05", 'tonase_kg_bulan' => 400.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ASEM JAJAR RT 11", 'tonase_kg_bulan' => 397.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DE JA PAN", 'tonase_kg_bulan' => 351.16, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKAR", 'tonase_kg_bulan' => 244.12, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKAR 2", 'tonase_kg_bulan' => 496.74, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANDAN", 'tonase_kg_bulan' => 231.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEHATI", 'tonase_kg_bulan' => 400.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS", 'tonase_kg_bulan' => 359.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS BERSERI 1", 'tonase_kg_bulan' => 456.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS BERSERI 2", 'tonase_kg_bulan' => 396.21, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS BERSERI 3", 'tonase_kg_bulan' => 300.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS BERSERI 4", 'tonase_kg_bulan' => 270.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS BERSERI 5", 'tonase_kg_bulan' => 391.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMPAS BERSERI 6", 'tonase_kg_bulan' => 503.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BASAM BUTO", 'tonase_kg_bulan' => 173.96, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GENCAR MANDIRI", 'tonase_kg_bulan' => 209.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN SEJAHTERA", 'tonase_kg_bulan' => 211.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "FLAMBOYAN", 'tonase_kg_bulan' => 235.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TUNAS MANDIRI", 'tonase_kg_bulan' => 370.1, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARYA MANDIRI", 'tonase_kg_bulan' => 208.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SINAMBUNG MULYO", 'tonase_kg_bulan' => 202.74, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KAMPUNG PECINAN", 'tonase_kg_bulan' => 408.04, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAROKAH JAYA", 'tonase_kg_bulan' => 462.1, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GRANTING BERSERI DAN SEJAHTERA", 'tonase_kg_bulan' => 184.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR BERSERI", 'tonase_kg_bulan' => 418.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRIKANDI", 'tonase_kg_bulan' => 147.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "IKHLAS JAYA", 'tonase_kg_bulan' => 400.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BANGKIT SEJAHTERA", 'tonase_kg_bulan' => 181.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GARUDA", 'tonase_kg_bulan' => 266.6, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEGARAN BERKAH", 'tonase_kg_bulan' => 355.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEGARAN MAKMUR", 'tonase_kg_bulan' => 405.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEGARAN SEJAHTERA", 'tonase_kg_bulan' => 355.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TAMAR BERSERI", 'tonase_kg_bulan' => 217.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BOUGENVILLE", 'tonase_kg_bulan' => 220.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KEJORA", 'tonase_kg_bulan' => 126.58, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KUPAS", 'tonase_kg_bulan' => 379.64, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "AMANAH", 'tonase_kg_bulan' => 392.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAROKAH", 'tonase_kg_bulan' => 255.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAROKAH 2", 'tonase_kg_bulan' => 435.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BINA LINGKUNGAN", 'tonase_kg_bulan' => 145.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "IDOLA RMH", 'tonase_kg_bulan' => 276.04, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERES 05", 'tonase_kg_bulan' => 163.59, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DINOYO R351K", 'tonase_kg_bulan' => 130.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GRASITU", 'tonase_kg_bulan' => 116.44, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KAMPUNG DINOYO", 'tonase_kg_bulan' => 255.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KAMPUNG DINOYO", 'tonase_kg_bulan' => 198.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KATUT 04", 'tonase_kg_bulan' => 327.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKAR JAYA", 'tonase_kg_bulan' => 230.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BIANG LALA", 'tonase_kg_bulan' => 302.6, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CABE RAWIT", 'tonase_kg_bulan' => 139.73, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAHLIA", 'tonase_kg_bulan' => 268.64, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "FLAMBOYAN", 'tonase_kg_bulan' => 384.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GAPAPA WES", 'tonase_kg_bulan' => 212.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKMUR JAYA", 'tonase_kg_bulan' => 236.66, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKTOR SAMPAH BERKAH 10", 'tonase_kg_bulan' => 211.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER BAROKAH", 'tonase_kg_bulan' => 267.95, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAS PECAH (MASYARAKAT PECINTA SAMPAH)", 'tonase_kg_bulan' => 250.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MULYA JAYA", 'tonase_kg_bulan' => 397.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "REJO ASRI 76", 'tonase_kg_bulan' => 179.27, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WIJAYA KUSUMA", 'tonase_kg_bulan' => 260.41, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRIKANDI MANDIRI", 'tonase_kg_bulan' => 194.42, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TERATAI", 'tonase_kg_bulan' => 176.44, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BRAYON (BANK GOTONG ROYONG)", 'tonase_kg_bulan' => 383.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SINAR SEJAHTERA 2", 'tonase_kg_bulan' => 152.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ASRI LESTARI PKK RW 4", 'tonase_kg_bulan' => 221.91, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BELIMBING WULUH", 'tonase_kg_bulan' => 210.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ELING RESIK PKK RT 2", 'tonase_kg_bulan' => 200.15, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GANAM SARI", 'tonase_kg_bulan' => 110.79, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KERTOMENANGGAL BERSERI", 'tonase_kg_bulan' => 123.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANCASILA", 'tonase_kg_bulan' => 184.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PELANGI", 'tonase_kg_bulan' => 493.42, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUSUN MENANGGAL PAK NARTO", 'tonase_kg_bulan' => 184.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ADINIUM MANDIRI", 'tonase_kg_bulan' => 330.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PELANGI SMART", 'tonase_kg_bulan' => 487.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAGA", 'tonase_kg_bulan' => 193.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERLIAN", 'tonase_kg_bulan' => 272.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BINTANG WIYATA RT 1", 'tonase_kg_bulan' => 129.42, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GKS (Gerakan Kendali Sampah)", 'tonase_kg_bulan' => 374.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KBS 5", 'tonase_kg_bulan' => 394.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KETINTANG 17", 'tonase_kg_bulan' => 396.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KETINTANG BAROKAH", 'tonase_kg_bulan' => 547.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LINGKUNGAN BERSIH 3 (LINGBER 3)", 'tonase_kg_bulan' => 126.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MERAK ASRI", 'tonase_kg_bulan' => 153.05, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PESONA WIYATA 4", 'tonase_kg_bulan' => 375.59, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PUSVETMA", 'tonase_kg_bulan' => 274.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEPULUH", 'tonase_kg_bulan' => 301.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WAHYU CELL MANDIRI", 'tonase_kg_bulan' => 221.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WOLU", 'tonase_kg_bulan' => 292.35, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAHKOTA JIWA", 'tonase_kg_bulan' => 233.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WISMEN LESTARI", 'tonase_kg_bulan' => 164.35, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "46", 'tonase_kg_bulan' => 494.21, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BECIK RESIK", 'tonase_kg_bulan' => 147.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BINTANG 5", 'tonase_kg_bulan' => 349.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BINTANG LIMA", 'tonase_kg_bulan' => 353.66, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CEMPAKA", 'tonase_kg_bulan' => 178.97, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DIANSATI RT 6", 'tonase_kg_bulan' => 138.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ENAM", 'tonase_kg_bulan' => 80.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GIRLI", 'tonase_kg_bulan' => 138.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN", 'tonase_kg_bulan' => 109.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HILDA REGENCY", 'tonase_kg_bulan' => 480.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JAMBANGAN RW. 06", 'tonase_kg_bulan' => 293.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JAS KEMBANG", 'tonase_kg_bulan' => 173.63, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LIDAH BUAYA", 'tonase_kg_bulan' => 400.36, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI", 'tonase_kg_bulan' => 227.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PITOE JAMBANGAN", 'tonase_kg_bulan' => 171.96, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN JAYA", 'tonase_kg_bulan' => 299.83, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMANGAT", 'tonase_kg_bulan' => 90.04, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SIJI", 'tonase_kg_bulan' => 423.12, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TEMA RT 5", 'tonase_kg_bulan' => 90.35, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WOLU", 'tonase_kg_bulan' => 424.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BIBIS KARAH", 'tonase_kg_bulan' => 292.19, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANGGA MADU", 'tonase_kg_bulan' => 213.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANGGA MANALAGI", 'tonase_kg_bulan' => 83.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "APEL", 'tonase_kg_bulan' => 91.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DELIMA CERIA", 'tonase_kg_bulan' => 463.59, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANGGA", 'tonase_kg_bulan' => 288.83, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANGGIS", 'tonase_kg_bulan' => 94.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MERAPAT", 'tonase_kg_bulan' => 492.52, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "NEMBANG (RT 6 BERKEMBANG)", 'tonase_kg_bulan' => 129.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SARINEM", 'tonase_kg_bulan' => 198.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMANGKA", 'tonase_kg_bulan' => 164.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TUMBUH KEMBANG", 'tonase_kg_bulan' => 279.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARGESS", 'tonase_kg_bulan' => 406.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GESANG GUYUB", 'tonase_kg_bulan' => 237.17, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN", 'tonase_kg_bulan' => 384.48, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HIDUP SEJAHTERA", 'tonase_kg_bulan' => 81.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HIJAU ASRI", 'tonase_kg_bulan' => 486.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "IJO RESIK", 'tonase_kg_bulan' => 345.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JAYA ASRI", 'tonase_kg_bulan' => 443.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LADYS SQUAD", 'tonase_kg_bulan' => 63.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANGIVERA RT 3", 'tonase_kg_bulan' => 87.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MELATI PUTIH", 'tonase_kg_bulan' => 142.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SABAR (SAMPAH BAROKAH)", 'tonase_kg_bulan' => 92.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEHATI", 'tonase_kg_bulan' => 61.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEROJA RT 4", 'tonase_kg_bulan' => 327.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TERPADU", 'tonase_kg_bulan' => 456.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH RT 4", 'tonase_kg_bulan' => 182.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JALA MARINA", 'tonase_kg_bulan' => 343.62, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KUMBANG", 'tonase_kg_bulan' => 112.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKAR JAYA", 'tonase_kg_bulan' => 350.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TANGGUH", 'tonase_kg_bulan' => 216.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ABADI", 'tonase_kg_bulan' => 394.64, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BELING MITRA (BERSIH LINGKUNGAN MITRA)", 'tonase_kg_bulan' => 414.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DALANE SUGEH", 'tonase_kg_bulan' => 340.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARYA SEJAHTERA", 'tonase_kg_bulan' => 69.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KDRT", 'tonase_kg_bulan' => 422.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR BERSEMI", 'tonase_kg_bulan' => 110.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MULYO BARENG", 'tonase_kg_bulan' => 359.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RAMAH BUMI", 'tonase_kg_bulan' => 257.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SERTU", 'tonase_kg_bulan' => 409.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER REZEKI", 'tonase_kg_bulan' => 356.63, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JITU", 'tonase_kg_bulan' => 136.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MITRA BAROKAH", 'tonase_kg_bulan' => 86.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HARAPAN MAJU", 'tonase_kg_bulan' => 221.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GENAH URIP", 'tonase_kg_bulan' => 265.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUP RUKUN", 'tonase_kg_bulan' => 441.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HATINYA RT 10", 'tonase_kg_bulan' => 474.05, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI", 'tonase_kg_bulan' => 181.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MOLIN JAYA", 'tonase_kg_bulan' => 251.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANDANG GENDHIS RT 10", 'tonase_kg_bulan' => 330.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PUNGJI", 'tonase_kg_bulan' => 498.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN MAKMUR RT 4", 'tonase_kg_bulan' => 315.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN SEHAT", 'tonase_kg_bulan' => 123.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI RT 2", 'tonase_kg_bulan' => 407.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SONGO LORO", 'tonase_kg_bulan' => 398.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TIRTA KUSUMA RT 3", 'tonase_kg_bulan' => 309.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GADIS", 'tonase_kg_bulan' => 469.6, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN", 'tonase_kg_bulan' => 330.62, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SANSIVERA", 'tonase_kg_bulan' => 323.95, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAWIS 4/5", 'tonase_kg_bulan' => 401.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAWIS 6/7", 'tonase_kg_bulan' => 127.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GEMILANG", 'tonase_kg_bulan' => 365.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GMH RT 2", 'tonase_kg_bulan' => 94.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI", 'tonase_kg_bulan' => 194.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MONCITERO", 'tonase_kg_bulan' => 64.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PITU MANDIRI", 'tonase_kg_bulan' => 471.97, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRIKANDI", 'tonase_kg_bulan' => 124.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAUN HIJAU", 'tonase_kg_bulan' => 78.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GASPOLL", 'tonase_kg_bulan' => 273.33, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GEMILANG SEJAHTERA", 'tonase_kg_bulan' => 457.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARTES", 'tonase_kg_bulan' => 446.83, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WANI RESIK", 'tonase_kg_bulan' => 139.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WOLU SONGO", 'tonase_kg_bulan' => 279.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BINTANG MANGROVE", 'tonase_kg_bulan' => 152.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CERIA", 'tonase_kg_bulan' => 150.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR", 'tonase_kg_bulan' => 348.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR 88", 'tonase_kg_bulan' => 333.15, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MELATI 1", 'tonase_kg_bulan' => 197.44, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MELATI 2", 'tonase_kg_bulan' => 125.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MITRA ROSAN", 'tonase_kg_bulan' => 68.16, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKTORAL ANGGREK", 'tonase_kg_bulan' => 145.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TERATAI 12", 'tonase_kg_bulan' => 190.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TERATAI 3", 'tonase_kg_bulan' => 132.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DUA ENAM", 'tonase_kg_bulan' => 474.17, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RAJIN", 'tonase_kg_bulan' => 447.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SALING KERJA RT 6", 'tonase_kg_bulan' => 89.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HARAPAN JAYA", 'tonase_kg_bulan' => 450.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KALI MAKMUR", 'tonase_kg_bulan' => 491.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TIGA 7", 'tonase_kg_bulan' => 310.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TUNAS MEKAR 1", 'tonase_kg_bulan' => 443.43, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TUNAS MEKAR 2", 'tonase_kg_bulan' => 178.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ALAM LESTARI", 'tonase_kg_bulan' => 195.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAKTI PERTIWI", 'tonase_kg_bulan' => 366.79, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CERIA", 'tonase_kg_bulan' => 361.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAMAI", 'tonase_kg_bulan' => 211.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MATAHARI", 'tonase_kg_bulan' => 287.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MY DARLING", 'tonase_kg_bulan' => 272.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TALES MERDEKA SAMPAH", 'tonase_kg_bulan' => 176.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAHONI", 'tonase_kg_bulan' => 227.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MUGI LESTARI", 'tonase_kg_bulan' => 97.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JW PROJECT", 'tonase_kg_bulan' => 108.22, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARYA MANDIRI", 'tonase_kg_bulan' => 212.74, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAREM F", 'tonase_kg_bulan' => 258.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MARTALIM", 'tonase_kg_bulan' => 127.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MARTASIK", 'tonase_kg_bulan' => 309.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SIDO MAKMUR", 'tonase_kg_bulan' => 228.36, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LANG SRIKANDI", 'tonase_kg_bulan' => 328.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CADETS 07", 'tonase_kg_bulan' => 146.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HIJAU LESTARI", 'tonase_kg_bulan' => 233.41, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KINTAMANI", 'tonase_kg_bulan' => 347.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KALIMIR SEJAHTERA", 'tonase_kg_bulan' => 368.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "NGAGEL SEJAHTERA", 'tonase_kg_bulan' => 203.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAROKAH", 'tonase_kg_bulan' => 300.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB SAYEKTI", 'tonase_kg_bulan' => 158.46, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MULYO RAHAYU", 'tonase_kg_bulan' => 325.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MULYOREJO", 'tonase_kg_bulan' => 152.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RAFFLESIA", 'tonase_kg_bulan' => 368.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SIJI OKE", 'tonase_kg_bulan' => 221.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PUCUK CANTIK", 'tonase_kg_bulan' => 123.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUBAIR ASRI", 'tonase_kg_bulan' => 328.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PAKAR RT. 03", 'tonase_kg_bulan' => 229.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RESIK GUBARPAT", 'tonase_kg_bulan' => 150.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BARATA BERJAYA", 'tonase_kg_bulan' => 388.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GOTONG ROYONG 1", 'tonase_kg_bulan' => 113.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GOTONG ROYONG 7", 'tonase_kg_bulan' => 108.15, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUP SEJAHTERA", 'tonase_kg_bulan' => 100.38, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KEMUNING INDAH", 'tonase_kg_bulan' => 128.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKMUR JAYA", 'tonase_kg_bulan' => 351.61, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI", 'tonase_kg_bulan' => 90.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BOGGI JAYA", 'tonase_kg_bulan' => 78.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DARLING (SADAR LINGKUNGAN)", 'tonase_kg_bulan' => 357.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUBENG JAYA MANDIRI", 'tonase_kg_bulan' => 170.43, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUBENG JAYA RT. 18", 'tonase_kg_bulan' => 326.26, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUBJA RT. 10", 'tonase_kg_bulan' => 96.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUBSI JAYA", 'tonase_kg_bulan' => 125.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "IJO ROYO ROYO", 'tonase_kg_bulan' => 309.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PKK", 'tonase_kg_bulan' => 203.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JUWINGAN GEMILANG", 'tonase_kg_bulan' => 345.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PILAH JAYA", 'tonase_kg_bulan' => 290.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKAR JAYA", 'tonase_kg_bulan' => 391.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "AMANAH", 'tonase_kg_bulan' => 327.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANGGREK BERSERI", 'tonase_kg_bulan' => 463.59, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANUGERAH JAYA", 'tonase_kg_bulan' => 291.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARJO MATIM", 'tonase_kg_bulan' => 312.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "B.I.A", 'tonase_kg_bulan' => 195.04, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BANGKIT BERSERI", 'tonase_kg_bulan' => 95.19, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BANGKIT JAYA", 'tonase_kg_bulan' => 449.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BAROKAH", 'tonase_kg_bulan' => 250.39, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH", 'tonase_kg_bulan' => 105.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH SENTOSA", 'tonase_kg_bulan' => 120.15, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CAHAYA BERKAH", 'tonase_kg_bulan' => 163.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GACEE", 'tonase_kg_bulan' => 85.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GARUDA 106", 'tonase_kg_bulan' => 339.26, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GIAT 14", 'tonase_kg_bulan' => 63.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GOYONG ROYONG", 'tonase_kg_bulan' => 343.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN", 'tonase_kg_bulan' => 251.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HARAPAN MULYA", 'tonase_kg_bulan' => 315.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "HOLOBIS", 'tonase_kg_bulan' => 353.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JAYA ABADI", 'tonase_kg_bulan' => 182.26, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "JORDHE", 'tonase_kg_bulan' => 142.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KADARSIH", 'tonase_kg_bulan' => 376.74, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KAWAN", 'tonase_kg_bulan' => 61.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KEBON PRING", 'tonase_kg_bulan' => 417.12, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KEMUNING", 'tonase_kg_bulan' => 279.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KITA BISA", 'tonase_kg_bulan' => 349.67, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LANCAR BERSAMA", 'tonase_kg_bulan' => 375.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LESTARI", 'tonase_kg_bulan' => 346.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LIMA MANDIRI", 'tonase_kg_bulan' => 492.52, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU BERSAMA RW 05 RT 05 ", 'tonase_kg_bulan' => 106.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU BERSAMA RW 12 RT 09", 'tonase_kg_bulan' => 406.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU JAYA", 'tonase_kg_bulan' => 117.67, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKMUR JAYA", 'tonase_kg_bulan' => 331.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR PUTIH", 'tonase_kg_bulan' => 81.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MELATI HARIM", 'tonase_kg_bulan' => 424.94, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MELATI PUTIH", 'tonase_kg_bulan' => 303.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MOJO CANTIK", 'tonase_kg_bulan' => 386.73, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MOJO IJO", 'tonase_kg_bulan' => 130.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MOJO TRI", 'tonase_kg_bulan' => 330.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "NUSA INDAH", 'tonase_kg_bulan' => 486.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PALEM", 'tonase_kg_bulan' => 129.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANCA TIRTA MAYA", 'tonase_kg_bulan' => 91.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PEDULI SEHAT", 'tonase_kg_bulan' => 92.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PUNDI MOJO", 'tonase_kg_bulan' => 187.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RAMAH", 'tonase_kg_bulan' => 87.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RESTU ABADI", 'tonase_kg_bulan' => 113.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN SEJAHTERA", 'tonase_kg_bulan' => 465.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBUNG URIP", 'tonase_kg_bulan' => 345.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SATYA BHAVANA", 'tonase_kg_bulan' => 202.22, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEDAP MALAM", 'tonase_kg_bulan' => 384.48, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEJAHTERA", 'tonase_kg_bulan' => 486.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKAR", 'tonase_kg_bulan' => 334.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKAR WANGI", 'tonase_kg_bulan' => 129.26, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SESARING", 'tonase_kg_bulan' => 75.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SETIA ABADI", 'tonase_kg_bulan' => 365.57, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEWELAS", 'tonase_kg_bulan' => 237.17, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SIKAMRO", 'tonase_kg_bulan' => 426.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRI REJEKI", 'tonase_kg_bulan' => 443.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRIKANDI", 'tonase_kg_bulan' => 107.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRIKANDI 09", 'tonase_kg_bulan' => 95.46, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "STEL KENDO", 'tonase_kg_bulan' => 435.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUKA SUKA", 'tonase_kg_bulan' => 456.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TANJUNG JAYA", 'tonase_kg_bulan' => 459.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KALIBOKOR KENCANA", 'tonase_kg_bulan' => 350.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANDIRI SEJAHTERA", 'tonase_kg_bulan' => 216.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BINTANG MANGROVE", 'tonase_kg_bulan' => 112.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PGR BERSINAR", 'tonase_kg_bulan' => 69.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKMI", 'tonase_kg_bulan' => 394.64, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER DANA", 'tonase_kg_bulan' => 343.62, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WINDU BERKAH", 'tonase_kg_bulan' => 182.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARENA (AREK RT. 06)", 'tonase_kg_bulan' => 356.63, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "IDOLA RMH", 'tonase_kg_bulan' => 359.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TMB MANDIRI 2", 'tonase_kg_bulan' => 422.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANYAR BERSERI", 'tonase_kg_bulan' => 340.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MANYAR MANDIRI", 'tonase_kg_bulan' => 414.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GOKLIN", 'tonase_kg_bulan' => 257.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAKURA MAS", 'tonase_kg_bulan' => 221.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAKURA MULYA", 'tonase_kg_bulan' => 86.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAKURA RAYA", 'tonase_kg_bulan' => 409.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER REJEKI", 'tonase_kg_bulan' => 110.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BUNAKEM", 'tonase_kg_bulan' => 251.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKMUR SEJAHTERA", 'tonase_kg_bulan' => 136.07, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARSA RUMAH SAMPAH", 'tonase_kg_bulan' => 123.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SRI REJEKI", 'tonase_kg_bulan' => 498.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKAR SARI", 'tonase_kg_bulan' => 265.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMANGGI", 'tonase_kg_bulan' => 181.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANYELIR 2", 'tonase_kg_bulan' => 330.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANYELIR 3", 'tonase_kg_bulan' => 474.05, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TERATAI", 'tonase_kg_bulan' => 315.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARYA GUNA", 'tonase_kg_bulan' => 441.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CENDRAWASIH", 'tonase_kg_bulan' => 407.69, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MLETO MAJU BERSAMA", 'tonase_kg_bulan' => 309.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "USAH CERIA", 'tonase_kg_bulan' => 398.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MASIDOSI 1", 'tonase_kg_bulan' => 469.6, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MASIDOSI 2", 'tonase_kg_bulan' => 323.95, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MASIDOSI 3", 'tonase_kg_bulan' => 330.62, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MASIDOSI 4", 'tonase_kg_bulan' => 124.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MASIDOSI 6", 'tonase_kg_bulan' => 365.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SURYA ABADI MANDIRI", 'tonase_kg_bulan' => 471.97, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BANK SAMPAH 95", 'tonase_kg_bulan' => 401.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CERIA NGINDEN", 'tonase_kg_bulan' => 94.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAHLIA", 'tonase_kg_bulan' => 64.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MESEM", 'tonase_kg_bulan' => 127.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBERIA 1 (SAMPAH BERSIH WARGA CERIA)", 'tonase_kg_bulan' => 194.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBERIA 2 (SAMPAH BERSIH WARGA CERIA)", 'tonase_kg_bulan' => 273.33, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBERIA 3 (SAMPAH BERSIH WARGA CERIA)", 'tonase_kg_bulan' => 78.29, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SAMBERIA 4 (SAMPAH BERSIH WARGA CERIA)", 'tonase_kg_bulan' => 457.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MITRA KGM", 'tonase_kg_bulan' => 446.83, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "NUSA INDAH", 'tonase_kg_bulan' => 279.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMANGAT GUYUB RUKUN", 'tonase_kg_bulan' => 139.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "EVORBIA", 'tonase_kg_bulan' => 150.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TRISNO JAYA", 'tonase_kg_bulan' => 125.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BUGER'S", 'tonase_kg_bulan' => 333.15, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KEMUNING", 'tonase_kg_bulan' => 152.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SABANDAWA", 'tonase_kg_bulan' => 197.44, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MY DARLING", 'tonase_kg_bulan' => 348.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RESMAN 06", 'tonase_kg_bulan' => 145.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "DAHLIA", 'tonase_kg_bulan' => 68.16, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PAMEVI", 'tonase_kg_bulan' => 250.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RUKUN MULYA", 'tonase_kg_bulan' => 107.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUKSES JAYA", 'tonase_kg_bulan' => 120.2, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MATAHARI", 'tonase_kg_bulan' => 99.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR", 'tonase_kg_bulan' => 250.73, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RIZKY SEJAHTERA", 'tonase_kg_bulan' => 119.81, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SERUNI", 'tonase_kg_bulan' => 144.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "QORYAH THOYYIBAH", 'tonase_kg_bulan' => 400.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANGGRAENI", 'tonase_kg_bulan' => 115.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANJANI", 'tonase_kg_bulan' => 190.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BEST OK 9", 'tonase_kg_bulan' => 123.22, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "CERIA", 'tonase_kg_bulan' => 300.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARTINI MODEREN", 'tonase_kg_bulan' => 111.57, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KEMANG TSAMANIAH MANDIRI", 'tonase_kg_bulan' => 308.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LANCAR JAYA", 'tonase_kg_bulan' => 500.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAJU BERSAMA", 'tonase_kg_bulan' => 205.48, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKMUR SENTOSA", 'tonase_kg_bulan' => 461.22, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PIONEER", 'tonase_kg_bulan' => 789.21, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEKAR SARI", 'tonase_kg_bulan' => 136.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEMBODRO", 'tonase_kg_bulan' => 300.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUNFLOWER", 'tonase_kg_bulan' => 152.33, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANGGREK", 'tonase_kg_bulan' => 465.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ASRI", 'tonase_kg_bulan' => 87.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN", 'tonase_kg_bulan' => 98.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "INDAH SEJAHTERAH", 'tonase_kg_bulan' => 106.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TWEBAR 6", 'tonase_kg_bulan' => 99.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "AHONG", 'tonase_kg_bulan' => 350.31, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ARTHA SAMPAH SEJAHTERA", 'tonase_kg_bulan' => 345.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GUYUB RUKUN KEDINDING", 'tonase_kg_bulan' => 443.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR MERAH", 'tonase_kg_bulan' => 216.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MENTARI", 'tonase_kg_bulan' => 112.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PARING BANK", 'tonase_kg_bulan' => 486.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TONGGO RUKUN BERKAH", 'tonase_kg_bulan' => 327.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "UTUN RUKUN", 'tonase_kg_bulan' => 87.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "BERKAH KARYA JAYA", 'tonase_kg_bulan' => 69.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KAMPUNG MANGGA", 'tonase_kg_bulan' => 182.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAKMUR BERSAMA", 'tonase_kg_bulan' => 343.62, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "NUSA INDAH", 'tonase_kg_bulan' => 200.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SUMBER MAKMUR/MAKMUR BERSAMA", 'tonase_kg_bulan' => 394.64, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GAUL 11 (GERAKAN UNTUK LINGKUNGAN 11)", 'tonase_kg_bulan' => 359.03, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GAUL 4 (GERAKAN UNTUK LINGKUNGAN 4)", 'tonase_kg_bulan' => 356.63, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "UNTUK BERSAMA", 'tonase_kg_bulan' => 422.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MERPATI", 'tonase_kg_bulan' => 414.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MUMPUNI", 'tonase_kg_bulan' => 257.14, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SYARIAH SAMAWA", 'tonase_kg_bulan' => 340.51, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "WANI", 'tonase_kg_bulan' => 110.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SONGOLIKOER", 'tonase_kg_bulan' => 409.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ANGGREK 12", 'tonase_kg_bulan' => 86.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GERABAK PISA", 'tonase_kg_bulan' => 221.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "LESTARI", 'tonase_kg_bulan' => 333.15, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SEJAHTERA HANG TUAH", 'tonase_kg_bulan' => 125.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MEKARSARI", 'tonase_kg_bulan' => 197.44, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SARI KUSUMA", 'tonase_kg_bulan' => 152.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN ASEMROWO", 'tonase_kg_bulan' => 183.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KANDANGAN 1", 'tonase_kg_bulan' => 99.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KANDANGAN 2", 'tonase_kg_bulan' => 129.57, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 61", 'tonase_kg_bulan' => 105.57, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KANDANGAN 3", 'tonase_kg_bulan' => 212.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SEMEMI 1", 'tonase_kg_bulan' => 82.66, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 40", 'tonase_kg_bulan' => 104.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 28", 'tonase_kg_bulan' => 126.93, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN LIDAH WETAN 2", 'tonase_kg_bulan' => 72.71, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDIT PERMATA", 'tonase_kg_bulan' => 114.61, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SD TANWIRUL AFKAR", 'tonase_kg_bulan' => 116.3, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN LONTAR 2", 'tonase_kg_bulan' => 104.05, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN LONTAR 481", 'tonase_kg_bulan' => 91.99, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 20", 'tonase_kg_bulan' => 87.66, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SURABAYA INTERCULTURAL SCHOOL", 'tonase_kg_bulan' => 104.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 33", 'tonase_kg_bulan' => 229.79, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 25", 'tonase_kg_bulan' => 207.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 50", 'tonase_kg_bulan' => 117.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 26", 'tonase_kg_bulan' => 84.44, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN MANUKAN KULON", 'tonase_kg_bulan' => 91.46, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN TANDES KIDUL 1", 'tonase_kg_bulan' => 101.27, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN BUBUTAN 4", 'tonase_kg_bulan' => 91.35, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN BUBUTAN 3", 'tonase_kg_bulan' => 203.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN GUNDIH", 'tonase_kg_bulan' => 108.91, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN JEPARA 1", 'tonase_kg_bulan' => 104.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN TEMBOK DUKUH", 'tonase_kg_bulan' => 97.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "OSIS SMK RAJASA", 'tonase_kg_bulan' => 135.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 3", 'tonase_kg_bulan' => 98.79, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 41", 'tonase_kg_bulan' => 109.1, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 42", 'tonase_kg_bulan' => 146.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 37", 'tonase_kg_bulan' => 158.13, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KAPASARI 8", 'tonase_kg_bulan' => 180.72, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KAPASARI 1", 'tonase_kg_bulan' => 103.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KAPASARI 5", 'tonase_kg_bulan' => 83.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KETABANG 1", 'tonase_kg_bulan' => 209.8, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KALIASIN I", 'tonase_kg_bulan' => 158.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMAN 1", 'tonase_kg_bulan' => 208.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN DR SOETOMO (BOUGENVILLE)", 'tonase_kg_bulan' => 100.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN DR. SOETOMO 5", 'tonase_kg_bulan' => 126.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "MAWAR SHARON CHRISTIAN SCHOOL", 'tonase_kg_bulan' => 150.6, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN DUKUH MENANGGAL 1", 'tonase_kg_bulan' => 106.96, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "UNIPA", 'tonase_kg_bulan' => 115.39, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 22", 'tonase_kg_bulan' => 81.39, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN MENANGGAL", 'tonase_kg_bulan' => 103.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SD DARUL ULUM", 'tonase_kg_bulan' => 89.33, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 36", 'tonase_kg_bulan' => 148.17, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KEBONSARI 1", 'tonase_kg_bulan' => 105.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN BANYU URIP 3", 'tonase_kg_bulan' => 100.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PAKIS 3", 'tonase_kg_bulan' => 133.7, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 46", 'tonase_kg_bulan' => 95.87, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PAKIS 5", 'tonase_kg_bulan' => 101.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANTI ASUHAN DON BOSCO I", 'tonase_kg_bulan' => 127.24, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDK SANTO VINCENTIUS", 'tonase_kg_bulan' => 117.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PETEMON", 'tonase_kg_bulan' => 92.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PETEMON 2", 'tonase_kg_bulan' => 105.11, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PANTI ASUHAN DON BOSCO II", 'tonase_kg_bulan' => 143.84, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SAWAHAN 4", 'tonase_kg_bulan' => 166.96, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN BABATAN 4", 'tonase_kg_bulan' => 163.17, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN JAJAR TUNGGAL 3", 'tonase_kg_bulan' => 127.1, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN BENDUL MERISI 408", 'tonase_kg_bulan' => 142.95, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SOSMA HMTL UINSA", 'tonase_kg_bulan' => 150.2, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 13", 'tonase_kg_bulan' => 129.81, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "UINSA WONOCOLO", 'tonase_kg_bulan' => 255.34, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SD SANTO CAROLUS", 'tonase_kg_bulan' => 196.61, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 57", 'tonase_kg_bulan' => 123.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SD AL FALAH", 'tonase_kg_bulan' => 92.16, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KB/TK IT AL USWAH", 'tonase_kg_bulan' => 108.18, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN NGAGEL 1 (PANDU KALPATARU)", 'tonase_kg_bulan' => 104.43, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN AIRLANGGA 1", 'tonase_kg_bulan' => 94.86, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 6", 'tonase_kg_bulan' => 124.83, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KERTAJAYA 9", 'tonase_kg_bulan' => 108.79, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMP AL ISLAH", 'tonase_kg_bulan' => 75.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN RUNGKUT MENANGGAL 1", 'tonase_kg_bulan' => 160.33, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KALIJUDAN 1", 'tonase_kg_bulan' => 189.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KALISARI 2 (BERKAH ILAHI)", 'tonase_kg_bulan' => 155.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMA GLORIA 2", 'tonase_kg_bulan' => 174.92, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN MANYAR SABRANGAN 2", 'tonase_kg_bulan' => 118.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 45", 'tonase_kg_bulan' => 102.47, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 17", 'tonase_kg_bulan' => 128.26, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN MEDOKAN AYU 1", 'tonase_kg_bulan' => 101.83, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN WONOREJO 1", 'tonase_kg_bulan' => 155.65, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ITS", 'tonase_kg_bulan' => 200.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 19", 'tonase_kg_bulan' => 189.49, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "UNTAG SURABAYA", 'tonase_kg_bulan' => 100.25, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMK 17 AGUSTUS", 'tonase_kg_bulan' => 121.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SEMOLOWARU 1", 'tonase_kg_bulan' => 135.75, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN GADING 3", 'tonase_kg_bulan' => 113.16, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PACARKELING 5", 'tonase_kg_bulan' => 125.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PACAR KEMBANG 1", 'tonase_kg_bulan' => 130.01, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN PLOSO 3", 'tonase_kg_bulan' => 100.47, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN RANGKAH 6", 'tonase_kg_bulan' => 226.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KENDANGSARI 1", 'tonase_kg_bulan' => 205.32, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN TENGGILIS MEJOYO 1", 'tonase_kg_bulan' => 107.47, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN BULAK RUKEM 2", 'tonase_kg_bulan' => 157.63, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 54", 'tonase_kg_bulan' => 174.82, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 18", 'tonase_kg_bulan' => 74.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SIDOTOPO WETAN", 'tonase_kg_bulan' => 132.62, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SIDOTOPO WETAN 2", 'tonase_kg_bulan' => 96.28, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 58", 'tonase_kg_bulan' => 100.05, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SIDOTOPO WETAN 5", 'tonase_kg_bulan' => 167.4, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SIDOTOPO WETAN 4", 'tonase_kg_bulan' => 541.2, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN SIDOTOPO WETAN 1", 'tonase_kg_bulan' => 101.39, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 15", 'tonase_kg_bulan' => 93.9, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN TANAH KALIKEDINDING 5", 'tonase_kg_bulan' => 129.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 60", 'tonase_kg_bulan' => 70.67, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN TANAH KALIKEDINDING 1", 'tonase_kg_bulan' => 145.5, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN KEDUNG COWEK 1", 'tonase_kg_bulan' => 165.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN DUPAK 1", 'tonase_kg_bulan' => 122.85, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMAK STELLA MARIS", 'tonase_kg_bulan' => 103.37, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMP KAWUNG 1", 'tonase_kg_bulan' => 168.95, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 5", 'tonase_kg_bulan' => 109.77, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN MOROKREMBANGAN 1", 'tonase_kg_bulan' => 92.53, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMP MUJAHIDIN", 'tonase_kg_bulan' => 136.54, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMP BARUNAWATI", 'tonase_kg_bulan' => 70.67, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 7", 'tonase_kg_bulan' => 108.68, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SMPN 8", 'tonase_kg_bulan' => 126.39, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN UJUNG 9", 'tonase_kg_bulan' => 600.564, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "SDN WONOKUSUMO 5", 'tonase_kg_bulan' => 158.56, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "REKOSISTEM SURABAYA", 'tonase_kg_bulan' => 180.55, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "RSUD BHAKTI DHARMA HUSADA", 'tonase_kg_bulan' => 134.02, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PT. INS GENERAL INDONESIA", 'tonase_kg_bulan' => 180.78, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP BG JUNCTION", 'tonase_kg_bulan' => 350.48, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PT. ICE CREAM ESKIMO", 'tonase_kg_bulan' => 357.09, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "IIK PERHUTANI JAWA TIMUR", 'tonase_kg_bulan' => 406.06, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP GALAXY MALL", 'tonase_kg_bulan' => 300.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP GRAND CITY", 'tonase_kg_bulan' => 230.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "KARAOKE SUKA-SUKA KAZA CITY", 'tonase_kg_bulan' => 326.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PT. KIMIA FARMA DIAGNOSTIKA - DARMO", 'tonase_kg_bulan' => 502.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP TUNJUNGAN PLAZA 3", 'tonase_kg_bulan' => 109.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP TUNJUNGAN PLAZA 4", 'tonase_kg_bulan' => 253.76, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GERAKAN PUNGUT SAMPAH", 'tonase_kg_bulan' => 150.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PRO EARTH INDONESIA", 'tonase_kg_bulan' => 300.89, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP CIPUTRA WORLD", 'tonase_kg_bulan' => 230.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "TUNAS HIJAU INDONESIA", 'tonase_kg_bulan' => 326.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP PAKUWON", 'tonase_kg_bulan' => 502.45, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PT. GRAHA DAMAI SEJAHTERA", 'tonase_kg_bulan' => 230.98, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "THE BODY SHOP ROYAL PLAZA", 'tonase_kg_bulan' => 326.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PAWONJANI", 'tonase_kg_bulan' => 326.88, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "ALANG-ALANG ZERO WASTE", 'tonase_kg_bulan' => 203.04, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "FIF CABANG SURABAYA 2", 'tonase_kg_bulan' => 455.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "GARDA PANGAN", 'tonase_kg_bulan' => 200.0, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "OTORITAS JASA KEUANGAN KANTOR REGIONAL 4", 'tonase_kg_bulan' => 573.23, 'created_at' => now()];
        $data_bank[] = ['nama_bank_sampah' => "PT. SAMUDRAYUANA ANJATRANS", 'tonase_kg_bulan' => 123.86, 'created_at' => now()];
        // Lokasi: SUPER DEPO SUTOREJO
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 9.89 * (rand(90, 110) / 100);
            $residu = 4.94 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "SUPER DEPO SUTOREJO", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: PDU JAMBANGAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 6.32 * (rand(90, 110) / 100);
            $residu = 3.37 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "PDU JAMBANGAN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: PEMILAHAN BRATANG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.71 * (rand(90, 110) / 100);
            $residu = 0.9 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "PEMILAHAN BRATANG", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R TAMBAK OSOWILANGUN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 8.17 * (rand(90, 110) / 100);
            $residu = 2.7 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R TAMBAK OSOWILANGUN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R TENGGILIS
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 5.4 * (rand(90, 110) / 100);
            $residu = 3.28 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R TENGGILIS", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R KEDUNG COWEK
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.74 * (rand(90, 110) / 100);
            $residu = 2.46 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R KEDUNG COWEK", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R GUNUNG ANYAR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.78 * (rand(90, 110) / 100);
            $residu = 2.48 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R GUNUNG ANYAR", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R KARANG PILANG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 3.62 * (rand(90, 110) / 100);
            $residu = 1.58 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R KARANG PILANG", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R WARU GUNUNG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.78 * (rand(90, 110) / 100);
            $residu = 2.38 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R WARU GUNUNG", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R BANJARSUGIHAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 6.01 * (rand(90, 110) / 100);
            $residu = 3.21 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R BANJARSUGIHAN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R TAMBAK WEDI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 8.39 * (rand(90, 110) / 100);
            $residu = 6.51 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R TAMBAK WEDI", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TPS3R SUMBER REJO
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 9.2 * (rand(90, 110) / 100);
            $residu = 4.84 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TPS3R SUMBER REJO", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: L O K A S I
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2025.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "L O K A S I", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: MENUR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.44 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "MENUR", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: KEPUTRAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 6.59 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "KEPUTRAN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: BRATANG
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 5.62 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "BRATANG", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: KAYOON
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.36 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "KAYOON", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: LIPONSOS KEPUTIH
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 0.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "LIPONSOS KEPUTIH", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: WONOREJO I
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 0.04 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "WONOREJO I", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: RUNGKUT ASRI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.11 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "RUNGKUT ASRI", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TENGGILIS UTARA
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2.83 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TENGGILIS UTARA", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TENGGILIS
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.21 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TENGGILIS", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: GAYUNGSARI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.79 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "GAYUNGSARI", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: BIBIS KARAH
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.34 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "BIBIS KARAH", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: JAMBANGAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 6.18 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "JAMBANGAN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: BALAS KLUMPRIK
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.81 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "BALAS KLUMPRIK", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: GUNUNGSARI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.78 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "GUNUNGSARI", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: PUTAT JAYA
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 0.54 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "PUTAT JAYA", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: SONOKWIJENAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 3.11 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "SONOKWIJENAN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TUBANAN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 0.3 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TUBANAN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: RUNGKUT MERR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 4.75 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "RUNGKUT MERR", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: IPLT KEPUTIH
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2.33 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "IPLT KEPUTIH", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: BABAT JERAWAT
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2.4 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "BABAT JERAWAT", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: MEDOKAN AYU
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2.93 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "MEDOKAN AYU", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: JANGKAR
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 3.37 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "JANGKAR", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: KYAI TAMBAK DERES
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 0.0 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "KYAI TAMBAK DERES", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: WONOREJO II
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 27.35 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "WONOREJO II", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: TAMBAK WEDI
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2.46 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "TAMBAK WEDI", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: MBAH RATU
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 1.27 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "MBAH RATU", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        // Lokasi: NGINDEN
        $startDate = Carbon::create(2025, 1, 1);
        for ($d = 0; $d < 180; $d++) {
            $tgl = $startDate->copy()->addDays($d)->format('Y-m-d');
            // Variasi Random +- 10%
            $masuk = 2.1 * (rand(90, 110) / 100);
            $residu = 0 * (rand(90, 110) / 100);
            
            $data_tps3r[] = [
                'lokasi' => "NGINDEN", 
                'tanggal' => $tgl, 
                'sampah_masuk_ton_hari' => $masuk, 
                'residu_ton_hari' => $residu, 
                'created_at' => now()
            ];
        }
        $data_armada[] = ['jenis_kendaraan' => "Dump Truk", 'jumlah_unit' => 28.0, 'created_at' => now()];
        $data_armada[] = ['jenis_kendaraan' => "Arm Roll Truck ", 'jumlah_unit' => 46.0, 'created_at' => now()];
        $data_armada[] = ['jenis_kendaraan' => "Compactor", 'jumlah_unit' => 81.0, 'created_at' => now()];
        $data_bbm[] = [
            'bulan_ke' => 1, 
            'nama_bulan' => 'January',
            'solar_liter' => 192546.0, 'dexlite_liter' => 23542.1643, 'pertamax_liter' => 8720.600699999999,
            'biaya_solar' => 1309312800.0, 'biaya_dexlite' => 342538490.565, 'biaya_pertamax' => 112931779.06499998,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 2, 
            'nama_bulan' => 'February',
            'solar_liter' => 199286.0, 'dexlite_liter' => 25165.650997, 'pertamax_liter' => 9472.75985,
            'biaya_solar' => 1355144800.0, 'biaya_dexlite' => 366160222.00635, 'biaya_pertamax' => 122672240.0575,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 3, 
            'nama_bulan' => 'March',
            'solar_liter' => 217046.0, 'dexlite_liter' => 26792.0295, 'pertamax_liter' => 9898.9614,
            'biaya_solar' => 1475912800.0, 'biaya_dexlite' => 389824029.225, 'biaya_pertamax' => 128191550.13,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 4, 
            'nama_bulan' => 'April',
            'solar_liter' => 201842.0, 'dexlite_liter' => 26936.348969, 'pertamax_liter' => 9030.0295,
            'biaya_solar' => 1372525600.0, 'biaya_dexlite' => 391923877.49895, 'biaya_pertamax' => 116938882.025,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 5, 
            'nama_bulan' => 'May',
            'solar_liter' => 218857.0, 'dexlite_liter' => 27178.65045, 'pertamax_liter' => 9887.5919,
            'biaya_solar' => 1488227600.0, 'biaya_dexlite' => 395449364.0475, 'biaya_pertamax' => 128044315.10499999,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 6, 
            'nama_bulan' => 'June',
            'solar_liter' => 209554.0, 'dexlite_liter' => 25199.760309, 'pertamax_liter' => 9721.5706,
            'biaya_solar' => 1424967200.0, 'biaya_dexlite' => 366656512.49595004, 'biaya_pertamax' => 125894339.27,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 7, 
            'nama_bulan' => 'July',
            'solar_liter' => 222200.0, 'dexlite_liter' => 25325.118832, 'pertamax_liter' => 9693.63066,
            'biaya_solar' => 1510960000.0, 'biaya_dexlite' => 368480479.0056, 'biaya_pertamax' => 125532517.047,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 8, 
            'nama_bulan' => 'August',
            'solar_liter' => 223386.0, 'dexlite_liter' => 26365.801238, 'pertamax_liter' => 9536.8095,
            'biaya_solar' => 1519024800.0, 'biaya_dexlite' => 383622408.0129, 'biaya_pertamax' => 123501683.02499999,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 9, 
            'nama_bulan' => 'September',
            'solar_liter' => 214816.0, 'dexlite_liter' => 25298.131815, 'pertamax_liter' => 9534.4205,
            'biaya_solar' => 1460748800.0, 'biaya_dexlite' => 368087817.90825003, 'biaya_pertamax' => 123470745.47500001,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 10, 
            'nama_bulan' => 'October',
            'solar_liter' => 0.0, 'dexlite_liter' => 26202.250079, 'pertamax_liter' => 9557.28,
            'biaya_solar' => 0.0, 'biaya_dexlite' => 381242738.64945, 'biaya_pertamax' => 123766776.00000001,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 11, 
            'nama_bulan' => 'November',
            'solar_liter' => 204140.7, 'dexlite_liter' => 25161.810115, 'pertamax_liter' => 8948.04,
            'biaya_solar' => 1388156760.0, 'biaya_dexlite' => 366104337.17325, 'biaya_pertamax' => 115877118.00000001,
            'created_at' => now()
        ];
        $data_bbm[] = [
            'bulan_ke' => 12, 
            'nama_bulan' => 'December',
            'solar_liter' => 267628.0, 'dexlite_liter' => 0, 'pertamax_liter' => 0,
            'biaya_solar' => 1819870400.0, 'biaya_dexlite' => 0, 'biaya_pertamax' => 0,
            'created_at' => now()
        ];
        $data_tpa[] = ['tahun' => 2025, 'total_tonase' => 592029.0, 'biaya_tipping_fee' => 137765853259.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2024, 'total_tonase' => 560060.0, 'biaya_tipping_fee' => 127535670285.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2023, 'total_tonase' => 561076.0, 'biaya_tipping_fee' => 125421949604.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2022, 'total_tonase' => 585856.0, 'biaya_tipping_fee' => 128456459987.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2021, 'total_tonase' => 580409.0, 'biaya_tipping_fee' => 119608758724.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2020, 'total_tonase' => 605610.0, 'biaya_tipping_fee' => 116598403616.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2019, 'total_tonase' => 618404.0, 'biaya_tipping_fee' => 111279282372.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2018, 'total_tonase' => 616617.0, 'biaya_tipping_fee' => 103715755412.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2017, 'total_tonase' => 602434.0, 'biaya_tipping_fee' => 94640493545.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2016, 'total_tonase' => 667610.0, 'biaya_tipping_fee' => 97202330877.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2015, 'total_tonase' => 472746.0, 'biaya_tipping_fee' => 64408333278.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2014, 'total_tonase' => 480364.0, 'biaya_tipping_fee' => 61225766518.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2013, 'total_tonase' => 467256.0, 'biaya_tipping_fee' => 56074392220.0, 'created_at' => now()];
        $data_tpa[] = ['tahun' => 2012, 'total_tonase' => 82781.0, 'biaya_tipping_fee' => 9850939000.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        $data_b3[] = ['jenis_limbah' => 'Limbah B3', 'berat_kg' => 2.0, 'created_at' => now()];
        foreach(array_chunk($data_fasilitas, 500) as $c) DB::table('master_fasilitas_rinci')->insert($c);
        foreach(array_chunk($data_bank, 500) as $c) DB::table('master_bank_sampah')->insert($c);
        foreach(array_chunk($data_armada, 500) as $c) DB::table('master_armada')->insert($c);
        foreach(array_chunk($data_bbm, 500) as $c) DB::table('laporan_bbm')->insert($c);
        foreach(array_chunk($data_tpa, 500) as $c) DB::table('laporan_tpa_rekap')->insert($c);
        
        // INSERT TPS3R (CHUNK BESAR)
        foreach(array_chunk($data_tps3r, 1000) as $c) DB::table('laporan_tps3r_harian')->insert($c);
        
        if(!empty($data_b3)) DB::table('laporan_b3_rt')->insert($data_b3);
    }
}
