<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kompos_lokasi', function (Blueprint $table) {
            $table->id('no'); // Primary Key Auto Increment
            $table->string('lokasi', 50);
            
            // Kolom Data 2025
            $table->decimal('bahan_masuk_2025', 8, 2)->default(0);
            $table->decimal('diolah_selain_kompos_2025', 8, 2)->default(0);
            $table->decimal('diolah_untuk_kompos_2025', 8, 2)->default(0);
            $table->decimal('hasil_produksi_2025', 8, 2)->default(0);
            
            // Kolom Data 2024
            $table->decimal('bahan_masuk_2024', 8, 2)->default(0);
            $table->decimal('diolah_selain_kompos_2024', 8, 2)->default(0);
            $table->decimal('diolah_untuk_kompos_2024', 8, 2)->default(0);
            $table->decimal('hasil_produksi_2024', 8, 2)->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompos_lokasi');
    }
};