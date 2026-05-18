<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_kualitas_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi')->comment('Nama lokasi pengujian');
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->enum('jenis_uji', ['air_sungai', 'air_laut', 'udara_ambien', 'tanah', 'kebisingan'])->comment('Jenis pengujian');
            $table->string('parameter_uji')->comment('Parameter yang diuji (BOD, COD, pH, PM10, dll)');
            $table->double('nilai_hasil')->nullable()->comment('Nilai hasil pengujian');
            $table->string('satuan')->nullable()->comment('Satuan pengukuran (mg/L, µg/m³, dB, dll)');
            $table->double('baku_mutu')->nullable()->comment('Baku mutu/standar');
            $table->enum('status', ['memenuhi', 'tidak_memenuhi', 'belum_diuji'])->default('belum_diuji');
            $table->date('tanggal_uji')->nullable();
            $table->integer('tahun')->default(2025);
            $table->string('sumber_data')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_kualitas_lingkungan');
    }
};
