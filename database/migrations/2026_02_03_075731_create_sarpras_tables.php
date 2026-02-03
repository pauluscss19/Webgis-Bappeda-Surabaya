<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Kebutuhan BBM Kendaraan
        Schema::create('kebutuhan_bbm_kendaraan_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_kendaraan', 50);
            $table->string('jenis_bbm', 20);
            $table->integer('jumlah_total')->nullable();
            $table->integer('jumlah_rusak')->nullable();
            $table->integer('jumlah_cadangan')->nullable();
            $table->integer('jumlah_beroperasi')->nullable();
            $table->decimal('kebutuhan_per_unit_pertamax', 10, 2)->nullable()->comment('Liter/hari');
            $table->decimal('kebutuhan_per_unit_dexlite', 10, 2)->nullable()->comment('Liter/hari');
            $table->decimal('kebutuhan_1_tahun_pertamax', 15, 2)->nullable();
            $table->decimal('kebutuhan_1_tahun_dexlite', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Kebutuhan BBM Peralatan
        Schema::create('kebutuhan_bbm_peralatan_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_peralatan', 50);
            $table->string('jenis_bbm', 20);
            $table->integer('jumlah_total')->nullable();
            $table->integer('jumlah_rusak')->nullable();
            $table->integer('jumlah_cadangan')->nullable();
            $table->integer('jumlah_beroperasi')->nullable();
            $table->decimal('kebutuhan_per_unit_pertamax', 10, 2)->nullable();
            $table->decimal('kebutuhan_per_unit_dexlite', 10, 2)->nullable();
            $table->decimal('kebutuhan_1_tahun_pertamax', 15, 2)->nullable();
            $table->decimal('kebutuhan_1_tahun_dexlite', 15, 2)->nullable();
            $table->timestamps();
        });

        // 3. Tabel RTH Skema CSR
        Schema::create('rth_skema_csrs', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi', 200);
            $table->string('penanggung_jawab', 100)->nullable();
            $table->string('bulan', 20)->nullable();
            $table->year('tahun')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rth_skema_csrs');
        Schema::dropIfExists('kebutuhan_bbm_peralatan_operasionals');
        Schema::dropIfExists('kebutuhan_bbm_kendaraan_operasionals');
    }
};