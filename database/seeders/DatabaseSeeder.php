<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // --- Data untuk Dashboard Statistik Lingkungan (Fasilitas & Aset) ---
            FasilitasPeralatanSeeder::class,
            ArmadaKendaraanSeeder::class,

            SarprasSeeder::class,
            bbm::class,

            KomposSeeder::class,
            KrematoriumSeeder::class,
            LuasanRthSeeder::class,
            UjiAirSeeder::class,
            UjiUdaraSeeder::class,

            // Data RTH/Makam/BBM lengkap (uncomment jika tabel terkait sudah ada):
            // CompleteDataSeeder::class, 
        ]);
    }
}
