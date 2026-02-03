<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Rekapitulasi RTH Taman
        Schema::create('rekapitulasi_rth_tamans', function (Blueprint $table) {
            $table->id();
            $table->string('wilayah', 20);
            $table->integer('jumlah_taman_pasif_jalur_hijau')->nullable();
            $table->decimal('luas_taman_pasif_jalur_hijau', 15, 2)->nullable();
            $table->integer('jumlah_taman_aktif')->nullable();
            $table->decimal('luas_taman_aktif', 15, 2)->nullable();
            $table->integer('jumlah_taman_kota')->nullable();
            $table->decimal('luas_taman_kota', 15, 2)->nullable();
            $table->integer('jumlah_per_wilayah')->nullable();
            $table->decimal('luas_per_wilayah', 15, 2)->nullable();
            $table->timestamps();
        });

        // 2. Tabel Rekapitulasi RTH Makam
        Schema::create('rekapitulasi_rth_makams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_makam', 100);
            $table->decimal('luas', 15, 2)->nullable();
            $table->timestamps();
        });

        // 3. Tabel Kapasitas Makam
        Schema::create('kapasitas_makams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi', 100);
            $table->string('tahun_operasional', 20)->nullable();
            $table->text('kelurahan')->nullable();
            $table->text('kecamatan')->nullable();
            $table->decimal('luas', 15, 2)->nullable();
            $table->decimal('luas_fasum', 15, 2)->nullable();
            $table->decimal('luas_lahan_efektif', 15, 2)->nullable();
            $table->string('kapasitas_makam', 20)->nullable();
            $table->integer('jumlah_data_kematian')->nullable();
            $table->integer('sisa_petak')->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->integer('jumlah_pegawai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kapasitas_makams');
        Schema::dropIfExists('rekapitulasi_rth_makams');
        Schema::dropIfExists('rekapitulasi_rth_tamans');
    }
};