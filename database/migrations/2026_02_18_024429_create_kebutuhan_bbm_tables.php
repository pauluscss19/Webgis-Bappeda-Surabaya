<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Peralatan
        Schema::create('kebutuhan_bbm_peralatan_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_peralatan')->nullable(); // Boleh kosong
            $table->string('jenis_bbm')->nullable();

            // SEMUA ANGKA DIBUAT NULLABLE (BOLEH KOSONG)
            $table->integer('jumlah_total')->nullable()->default(0);
            $table->integer('jumlah_beroperasi')->nullable()->default(0);
            $table->integer('jumlah_rusak')->nullable()->default(0);
            $table->integer('jumlah_cadangan')->nullable()->default(0);

            // BBM JUGA NULLABLE
            $table->decimal('kebutuhan_per_unit_pertamax', 15, 2)->nullable()->default(0);
            $table->decimal('kebutuhan_per_unit_dexlite', 15, 2)->nullable()->default(0);
            $table->decimal('kebutuhan_1_tahun_pertamax', 15, 2)->nullable()->default(0);
            $table->decimal('kebutuhan_1_tahun_dexlite', 15, 2)->nullable()->default(0);

            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Kendaraan (Target Masalah Tadi)
        Schema::create('kebutuhan_bbm_kendaraan_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_kendaraan')->nullable(); // Boleh kosong
            $table->string('jenis_bbm')->nullable();

            // DI SINI MASALAHNYA TADI (jumlah_cadangan), SEKARANG KITA IZINKAN NULL
            $table->integer('jumlah_total')->nullable()->default(0);
            $table->integer('jumlah_beroperasi')->nullable()->default(0);
            $table->integer('jumlah_rusak')->nullable()->default(0);
            $table->integer('jumlah_cadangan')->nullable()->default(0); // <--- INI SOLUSINYA

            // BBM JUGA NULLABLE
            $table->decimal('kebutuhan_per_unit_pertamax', 15, 2)->nullable()->default(0);
            $table->decimal('kebutuhan_per_unit_dexlite', 15, 2)->nullable()->default(0);
            $table->decimal('kebutuhan_1_tahun_pertamax', 15, 2)->nullable()->default(0);
            $table->decimal('kebutuhan_1_tahun_dexlite', 15, 2)->nullable()->default(0);

            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_bbm_peralatan_operasionals');
        Schema::dropIfExists('kebutuhan_bbm_kendaraan_operasionals');
    }
};
