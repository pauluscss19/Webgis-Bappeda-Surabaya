<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan namespace model User sesuai dengan aplikasi Anda

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrCreate untuk mencegah duplikasi jika seeder dijalankan ulang
        User::updateOrCreate(
            ['email' => 'admin@surabaya.go.id'], // Kunci pencarian (Cek apakah email ini ada)
            [
                'name' => 'Administrator Surabaya', // Nama default
                'password' => Hash::make('surabaya123'), // Password wajib di-hash
                'email_verified_at' => now(), // Langsung verifikasi email
            ]
        );
    }
}
