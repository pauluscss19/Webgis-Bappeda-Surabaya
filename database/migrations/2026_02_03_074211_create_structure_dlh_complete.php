<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. MASTER FASILITAS
        Schema::create('master_fasilitas_rinci', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fasilitas')->nullable();
            $table->string('nama_fasilitas')->nullable();
            $table->string('jenis_fasilitas')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->double('timbulan_sampah_masuk_kg')->nullable();
            $table->double('timbulan_diolah_kg')->nullable();
            $table->double('volume_angkut_tpa_kg')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });

        // 2. MASTER BANK SAMPAH
        Schema::create('master_bank_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bank_sampah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('wilayah')->nullable(); 
            $table->string('status')->nullable(); 
            $table->double('tonase_kg_bulan')->nullable();
            $table->string('pengurus')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });

        // 3. LAPORAN TPS3R (HARIAN)
        Schema::create('laporan_tps3r_harian', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi')->nullable(); 
            $table->date('tanggal')->nullable(); // Ubah jadi DATE biar real
            $table->double('sampah_masuk_ton_hari')->nullable();
            $table->double('organik_ton_hari')->nullable();
            $table->double('anorganik_kertas_ton_hari')->nullable();
            $table->double('anorganik_plastik_ton_hari')->nullable();
            $table->double('anorganik_lain_ton_hari')->nullable();
            $table->double('residu_ton_hari')->nullable(); 
            $table->timestamps();
        });

        // 4. LAPORAN B3
        Schema::create('laporan_b3_rt', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi')->nullable();
            $table->string('bulan')->nullable();
            $table->integer('tahun')->default(2025);
            $table->string('jenis_limbah')->nullable(); 
            $table->double('berat_kg')->nullable();
            $table->timestamps();
        });

        // 5. MASTER ARMADA
        Schema::create('master_armada', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kendaraan')->nullable();
            $table->integer('jumlah_unit')->nullable();
            $table->string('satuan')->nullable();
            $table->string('kepemilikan')->nullable();
            $table->timestamps();
        });

        // 6. LAPORAN BBM
        Schema::create('laporan_bbm', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan_ke');
            $table->string('nama_bulan');
            $table->double('solar_liter')->default(0);
            $table->double('dexlite_liter')->default(0);
            $table->double('pertamax_liter')->default(0);
            $table->timestamps();
        });

        // 7. SAMPAH TPA
        Schema::create('laporan_tpa_rekap', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->double('total_tonase')->nullable();
            $table->double('rata_rata_harian')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_fasilitas_rinci');
        Schema::dropIfExists('master_bank_sampah');
        Schema::dropIfExists('laporan_tps3r_harian');
        Schema::dropIfExists('laporan_b3_rt');
        Schema::dropIfExists('master_armada');
        Schema::dropIfExists('laporan_bbm');
        Schema::dropIfExists('laporan_tpa_rekap');
    }
};