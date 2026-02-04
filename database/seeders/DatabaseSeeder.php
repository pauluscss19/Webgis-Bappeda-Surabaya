<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // PANGGIL FILE SEEDER KITA DI SINI
        $this->call([
            SarprasSeeder::class,
            komposSeeder::class,
            krematoriumSeeder::class,
            luasanRthSeeder::class,
            ujiairSeeder::class,
            ujiudaraSeeder::class,
            bbm::class,
            completedataSeeder::class,
        ]);
    }
}
