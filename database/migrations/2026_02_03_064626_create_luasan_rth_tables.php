<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Luasan RTH (Detail)
        Schema::create('luasan_rth_dprkpps', function (Blueprint $table) {
            $table->id();
            $table->char('tipologi', 1)->comment('A, B, atau C');
            $table->string('zona');
            $table->string('kode')->nullable();
            $table->decimal('luas', 10, 2)->nullable();
            $table->decimal('bobot', 5, 2)->nullable()->comment('Dalam persen, misal 100 = 100%');
            $table->decimal('luas_x_bobot', 10, 2)->nullable();
            $table->decimal('fhbi', 5, 2)->nullable();
            $table->decimal('jumlah', 10, 2)->nullable();
            $table->timestamps();
        });

        // 2. Tabel Persentase per Tipologi
        Schema::create('persentase_tipologis', function (Blueprint $table) {
            $table->id();
            $table->char('tipologi', 1)->unique();
            $table->decimal('persentase', 5, 2);
            $table->timestamps();
        });

        // 3. Tabel Ringkasan RTH Kota Surabaya
        Schema::create('ringkasan_rth_kotas', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->decimal('nilai', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ringkasan_rth_kotas');
        Schema::dropIfExists('persentase_tipologis');
        Schema::dropIfExists('luasan_rth_dprkpps');
    }
};