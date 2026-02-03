<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UjiAirSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // 1. TABLE: UJI AIR BADAN AIR (41 TITIK)
        // ============================================================
        $badanAir = [
            ['nama_sungai' => 'Kali Surabaya di Jembatan Wonokromo', 'koordinat' => 'S 7o17\'59.02" E 112o44\'15.46"', 'keterangan' => 'Dalam 1 tahun pengambilan sampel air badan air sebanyak 180 sampel. Data yang diperoleh 180 data/tahun'],
            ['nama_sungai' => 'Kali Mas di Jembatan Ngagel', 'koordinat' => 'S 7o17\'48.81" E 112o44\'30.45"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Mas di Jembatan Keputran Selatan', 'koordinat' => 'S 7o16\'38.31" E 112o44\'38.72"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Mas di Jembatan Kebonrojo', 'koordinat' => 'S 7o14\'35.12" E 112o44\'22.66"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Surabaya di Perbatasan Sby - Gresik', 'koordinat' => 'S 7o35\'17.16" E 112o66\'21.50"', 'keterangan' => null],
            ['nama_sungai' => 'Kalimas di PJT Kayun', 'koordinat' => 'S 7o16\'059" E 112o44\'981"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Surabaya di Jembatan Karangpilang Baru', 'koordinat' => 'S 7o19\'21.87" E 112o42\'36.57"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Surabaya di Intake PDAM Karangpilang', 'koordinat' => 'S 7o34\'78.26" E 112o68\'20.41"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Jeblokan di Jl. Petojo', 'koordinat' => 'S 7o15\'49.19" E 112o45\'25.22"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Wonokromo di Jembatan Jl. Nginden', 'koordinat' => 'S 7o18\'47.00" E 112o46\'095"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Kebonagung di Jl. Rungkut Industri', 'koordinat' => 'S 7o19\'51.75" E 112o45\'50.88"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Wonokromo di Jembatan MERR', 'koordinat' => 'S 7o18\'38.66" E 112o46\'49.54"', 'keterangan' => null],
            ['nama_sungai' => 'Boezem Kedurus', 'koordinat' => 'S 7o19\'18.67" E 112o42\'09.22"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Kedurus di Lidah Kulon', 'koordinat' => 'S 7o18\'53.73" E 112o39\'07.21"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Pegirian di Jl. Undaan', 'koordinat' => 'S 7o15\'17.65" E 112o44\'36.97"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Darmo di Rumah Pompa Darmokali', 'koordinat' => 'S 7°17\'21.11" E 112°44\'21.43"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Pegirian di Jl. Pegirian', 'koordinat' => 'S 7°13\'40.44" E 112°44\'36.52"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Greges di Jembatan Jl. Dupak', 'koordinat' => 'S 7°14\'42.93" E 112°43\'3.37"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Wonorejo - Wonokromo di Jembatan Kedung Baruk Utara', 'koordinat' => 'S 7o18\'34.03" E 112o47\'48.00"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Kandangan di Tb. Osowilangun', 'koordinat' => 'S 7°13\'46.20" E 112°39\'40.25"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Dinoyo di Rumah Pompa Dinoyo', 'koordinat' => 'S 7°16\'21.49" E 112°44\'36.76"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Kenari di Rumah Pompa Kenari', 'koordinat' => 'S 7o15\'40.48" E 112o44\'31.96"', 'keterangan' => null],
            ['nama_sungai' => 'Boezem Kalidami', 'koordinat' => 'S 7°16\'26.04" E 112°48\'04.82"', 'keterangan' => null],
            ['nama_sungai' => 'Boezem Wonorejo', 'koordinat' => 'S 7°18\'36.86" E 112°49\'22.10"', 'keterangan' => null],
            ['nama_sungai' => 'Boezem Morokrembangan', 'koordinat' => 'S 7°13\'56.80" E 112°43\'8.49"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Banyuurip di Rumah Pompa Gunungsari', 'koordinat' => 'S 7°18\'23.90" E 112°43\'11.22"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Margomulyo di Jl. Kalianak', 'koordinat' => 'S 7°13\'47.18" E 112°40\'54.93"', 'keterangan' => null],
            ['nama_sungai' => 'Kalidami di Jembatan Jl. Dharmahusada', 'koordinat' => 'S 7°27\'75.59" E 112°77\'26.38"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Tambak Wedi di Rumah Pompa Tb. Wedi', 'koordinat' => 'S 7°12\'23.26" E 112°46\'08.32"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Lebak Indah di Depan THP Kenjeran', 'koordinat' => 'S 7°14\'20.84" E 112°47\'42.36"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Kalibokor', 'koordinat' => 'S 7°17\'14.40" E 112°45\'27.61"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Kali Sumo', 'koordinat' => 'S 7°17\'26.66" E 112°44\'47.21"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Balongsari', 'koordinat' => 'S 7°15\'29.92" E 112°40\'37.41"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Sememi', 'koordinat' => 'S 7°14\'33.69" E 112°37\'51.48"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Simo', 'koordinat' => 'S 7°15\'38.53" E 112°42\'46.27"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Kali Kepiting', 'koordinat' => 'S 7°15\'34.18" E 112°48\'22.90"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Benowo Pasar', 'koordinat' => 'S 7°14\'08.71" E 112°36\'40.50"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Larangan', 'koordinat' => 'S 7°14\'26.53" E 112°47\'51.19"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Medokan Ayu', 'koordinat' => 'S 7°19\'00.98" E 112°48\'47.87"', 'keterangan' => null],
            ['nama_sungai' => 'Saluran Primer Medokan Semampir', 'koordinat' => 'S 7°18\'24.77" E 112°47\'56.33"', 'keterangan' => null],
            ['nama_sungai' => 'Kali Krembangan di Jl. Kalianak', 'koordinat' => 'S 7°13\'48.29" E 112°41\'45.92"', 'keterangan' => null],
        ];
        DB::table('uji_air_badan_air')->insert($badanAir);

        // ============================================================
        // 2. TABLE: UJI AIR LAUT - KAWASAN PELABUHAN
        // ============================================================
        $pelabuhan = [
            ['nama_lokasi' => 'Nilam Timur', 'koordinat' => '7°12\'12.9"S - 112°43\'22.0"E', 'keterangan' => 'Dilaksanakan 2x dalam setahun. Data yang diperoleh 24 data termasuk data plankton'],
            ['nama_lokasi' => 'Jamrud Utara', 'koordinat' => '7°11\'47.57"S - 112°43\'55.95"E', 'keterangan' => null],
        ];
        DB::table('uji_air_laut_pelabuhan')->insert($pelabuhan);

        // ============================================================
        // 3. TABLE: UJI AIR LAUT - KAWASAN WISATA BAHARI
        // ============================================================
        $wisata = [
            ['nama_lokasi' => 'Nilam Timur Kenjeran Pulau Pasir', 'koordinat' => '7°14\'13.8"S - 112°48\'13.8"E'],
            ['nama_lokasi' => 'Kenjeran Pengasapan Ikan', 'koordinat' => '7°13\'54.5"S - 112°47\'42.2"E'],
        ];
        DB::table('uji_air_laut_wisata_bahari')->insert($wisata);

        // ============================================================
        // 4. TABLE: UJI AIR LAUT - KAWASAN BIOTA LAUT
        // ============================================================
        $biota = [
            ['nama_lokasi' => 'Gunung Anyar Kali UPN', 'koordinat' => '7°20\'05.3"S - 112°49\'49.7"E'],
            ['nama_lokasi' => 'Muara Wonorejo', 'koordinat' => '7°19\'43.1"S - 112°50\'19.6"E'],
            ['nama_lokasi' => 'Kali Lamong 1', 'koordinat' => '7°13\'23.5"S - 112°41\'04.5"E'],
            ['nama_lokasi' => 'Kali Lamong 2', 'koordinat' => '7°13\'08.4"S - 112°40\'58.4"E'],
        ];
        DB::table('uji_air_laut_biota_laut')->insert($biota);
    }
}