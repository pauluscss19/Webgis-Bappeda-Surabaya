<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataStatistikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter tab, default ke 'sampah'
        $tab = $request->query('tab', 'sampah');

        // Data Hardcoded dari Excel DLH (Data Sampah)
        $dataSampah = [
            // Ringkasan Atas (Scorecards)
            'summary' => [
                'total_tpa' => '592.029', // Ton (2025)
                'avg_harian' => '1.621',  // Ton/Hari
                'bank_sampah' => '670',   // Unit
                'armada' => '513'         // Unit Truk
            ],

            // A. Grafik Tren TPA (2018-2025)
            'tpa' => [
                'tahun' => [2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025],
                'tonase' => [616617, 618404, 605610, 580409, 585856, 561076, 560060, 592029]
            ],

            // B. Efektivitas TPS 3R (Top Lokasi)
            'tps3r' => [
                'lokasi' => ["Sutorejo", "Jambangan", "Bratang", "Osowilangun", "Tenggilis", "Kedung Cowek", "Gunung Anyar", "Karang Pilang", "Waru Gunung", "Banjarsugihan", "Tambak Wedi", "Sumber Rejo"],
                'terolah' => [4.95, 2.94, 0.81, 5.47, 2.12, 2.28, 2.29, 2.04, 2.4, 2.8, 1.87, 4.36],
                'residu' => [4.94, 3.37, 0.9, 2.7, 3.28, 2.46, 2.48, 1.58, 2.38, 3.21, 6.51, 4.84]
            ],

            // C. Bank Sampah
            'bank_sampah' => [
                'wilayah_label' => ['Surabaya Selatan', 'Surabaya Timur', 'Surabaya Barat', 'Surabaya Pusat', 'Surabaya Utara'],
                'wilayah_data' => [203, 170, 115, 105, 77],
                'top_5' => [
                    ['nama' => 'PIONEER', 'wilayah' => 'UTARA', 'tonase' => 789.2],
                    ['nama' => 'SUMBER BAROKAH', 'wilayah' => 'PUSAT', 'tonase' => 601.6],
                    ['nama' => 'SDN UJUNG 9', 'wilayah' => 'UTARA', 'tonase' => 600.5],
                    ['nama' => 'OTORITAS JASA KEUANGAN', 'wilayah' => 'UTARA', 'tonase' => 573.2],
                    ['nama' => 'THE BODY SHOP PAKUWON', 'wilayah' => 'SELATAN', 'tonase' => 502.4],
                ]
            ]
        ];

        return view('pages.data-statistik', compact('tab', 'dataSampah'));
    }
}