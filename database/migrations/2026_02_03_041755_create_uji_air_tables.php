<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Uji Air Badan Air
        Schema::create('uji_air_badan_air', function (Blueprint $table) {
            $table->id(); // Pengganti kolom 'no'
            $table->string('nama_sungai');
            $table->string('koordinat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Uji Air Laut - Kawasan Pelabuhan
        Schema::create('uji_air_laut_pelabuhan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->string('koordinat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 3. Tabel Uji Air Laut - Kawasan Wisata Bahari
        Schema::create('uji_air_laut_wisata_bahari', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->string('koordinat')->nullable();
            $table->timestamps();
        });

        // 4. Tabel Uji Air Laut - Kawasan Biota Laut
        Schema::create('uji_air_laut_biota_laut', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->string('koordinat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uji_air_laut_biota_laut');
        Schema::dropIfExists('uji_air_laut_wisata_bahari');
        Schema::dropIfExists('uji_air_laut_pelabuhan');
        Schema::dropIfExists('uji_air_badan_air');
    }
};