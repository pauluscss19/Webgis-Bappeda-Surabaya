<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Uji Udara Ambien Particulate Counter (60 Titik)
        Schema::create('uji_udara_ambien_particulate_counters', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('peruntukan_kawasan')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Uji Udara Passive Sampler (4 Titik)
        Schema::create('uji_udara_passive_samplers', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->string('kawasan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 3. Tabel Sumur Pantau (2 Titik)
        Schema::create('sumur_pantaus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sumur');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 4. Tabel SPKUA (2 Titik)
        Schema::create('spkuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_spkua');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spkuas');
        Schema::dropIfExists('sumur_pantaus');
        Schema::dropIfExists('uji_udara_passive_samplers');
        Schema::dropIfExists('uji_udara_ambien_particulate_counters');
    }
};