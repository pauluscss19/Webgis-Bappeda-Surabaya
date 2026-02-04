<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class bbm extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // DATA BBM MANUAL (JANUARI - DESEMBER)
        // Sesuai Excel: Solar @6.800, Dexlite @14.550, Pertamax @12.950
        // ==========================================
        
        $data_bbm = [];

        // JANUARI
        $data_bbm[] = [
            'bulan_ke' => 1, 'nama_bulan' => 'Januari',
            'solar_liter' => 192546.0, 
            'dexlite_liter' => 23542.1643, 
            'pertamax_liter' => 8720.6007,
            'biaya_solar' => 1309312800.0, 
            'biaya_dexlite' => 342538490.57, 
            'biaya_pertamax' => 112931779.07,
            'created_at' => now()
        ];

        // FEBRUARI
        $data_bbm[] = [
            'bulan_ke' => 2, 'nama_bulan' => 'Februari',
            'solar_liter' => 199286.0, 
            'dexlite_liter' => 25165.65, 
            'pertamax_liter' => 9472.76,
            'biaya_solar' => 1355144800.0, 
            'biaya_dexlite' => 366160207.50, 
            'biaya_pertamax' => 122672242.00,
            'created_at' => now()
        ];

        // MARET
        $data_bbm[] = [
            'bulan_ke' => 3, 'nama_bulan' => 'Maret',
            'solar_liter' => 217046.0, 
            'dexlite_liter' => 26792.03, 
            'pertamax_liter' => 9898.96,
            'biaya_solar' => 1475912800.0, 
            'biaya_dexlite' => 389824036.50, 
            'biaya_pertamax' => 128191532.00,
            'created_at' => now()
        ];

        // APRIL
        $data_bbm[] = [
            'bulan_ke' => 4, 'nama_bulan' => 'April',
            'solar_liter' => 201842.0, 
            'dexlite_liter' => 26936.35, 
            'pertamax_liter' => 9030.03,
            'biaya_solar' => 1372525600.0, 
            'biaya_dexlite' => 391923892.50, 
            'biaya_pertamax' => 116938888.50,
            'created_at' => now()
        ];

        // MEI
        $data_bbm[] = [
            'bulan_ke' => 5, 'nama_bulan' => 'Mei',
            'solar_liter' => 218857.0, 
            'dexlite_liter' => 26568.65, 
            'pertamax_liter' => 9887.59,
            'biaya_solar' => 1488227600.0, 
            'biaya_dexlite' => 386573857.50, 
            'biaya_pertamax' => 128044290.50,
            'created_at' => now()
        ];

        // JUNI
        $data_bbm[] = [
            'bulan_ke' => 6, 'nama_bulan' => 'Juni',
            'solar_liter' => 209554.0, 
            'dexlite_liter' => 24859.76, 
            'pertamax_liter' => 9712.57,
            'biaya_solar' => 1424967200.0, 
            'biaya_dexlite' => 361709508.00, 
            'biaya_pertamax' => 125777781.50,
            'created_at' => now()
        ];

        // JULI
        $data_bbm[] = [
            'bulan_ke' => 7, 'nama_bulan' => 'Juli',
            'solar_liter' => 222200.0, 
            'dexlite_liter' => 27425.12, 
            'pertamax_liter' => 9832.88,
            'biaya_solar' => 1510960000.0, 
            'biaya_dexlite' => 399035496.00, 
            'biaya_pertamax' => 127335796.00,
            'created_at' => now()
        ];

        // AGUSTUS
        $data_bbm[] = [
            'bulan_ke' => 8, 'nama_bulan' => 'Agustus',
            'solar_liter' => 223386.0, 
            'dexlite_liter' => 26165.80, 
            'pertamax_liter' => 9543.81,
            'biaya_solar' => 1519024800.0, 
            'biaya_dexlite' => 380712390.00, 
            'biaya_pertamax' => 123592339.50,
            'created_at' => now()
        ];

        // SEPTEMBER
        $data_bbm[] = [
            'bulan_ke' => 9, 'nama_bulan' => 'September',
            'solar_liter' => 214816.0, 
            'dexlite_liter' => 24963.13, 
            'pertamax_liter' => 9617.42,
            'biaya_solar' => 1460748800.0, 
            'biaya_dexlite' => 363213541.50, 
            'biaya_pertamax' => 124545589.00,
            'created_at' => now()
        ];

        // OKTOBER
        $data_bbm[] = [
            'bulan_ke' => 10, 'nama_bulan' => 'Oktober',
            'solar_liter' => 218500.0, // Estimasi (Data Excel kosong/strip)
            'dexlite_liter' => 26067.25, 
            'pertamax_liter' => 9697.28,
            'biaya_solar' => 1485800000.0, 
            'biaya_dexlite' => 379278487.50, 
            'biaya_pertamax' => 125579776.00,
            'created_at' => now()
        ];

        // NOVEMBER
        $data_bbm[] = [
            'bulan_ke' => 11, 'nama_bulan' => 'November',
            'solar_liter' => 204140.7, 
            'dexlite_liter' => 24741.81, 
            'pertamax_liter' => 9018.04,
            'biaya_solar' => 1388156760.0, 
            'biaya_dexlite' => 359993335.50, 
            'biaya_pertamax' => 116783618.00,
            'created_at' => now()
        ];

        // DESEMBER
        $data_bbm[] = [
            'bulan_ke' => 12, 'nama_bulan' => 'Desember',
            'solar_liter' => 267628.0, 
            'dexlite_liter' => 25000.0, // Estimasi penutup tahun
            'pertamax_liter' => 9500.0, // Estimasi penutup tahun
            'biaya_solar' => 1819870400.0, 
            'biaya_dexlite' => 363750000.00, 
            'biaya_pertamax' => 123025000.00,
            'created_at' => now()
        ];
    }
}
