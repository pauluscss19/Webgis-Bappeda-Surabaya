<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->string('kelurahan')->nullable();
            $table->double('volume_sampah_ton')->default(0)->comment('Volume sampah dalam ton');
            $table->double('sampah_terangkut_ton')->default(0)->comment('Sampah yang terangkut (ton)');
            $table->double('sampah_diolah_ton')->default(0)->comment('Sampah yang diolah (ton)');
            $table->double('sampah_tidak_terkelola_ton')->default(0)->comment('Sampah tidak terkelola (ton)');
            $table->integer('jumlah_tps')->default(0)->comment('Jumlah TPS');
            $table->integer('jumlah_bank_sampah')->default(0)->comment('Jumlah Bank Sampah');
            $table->string('sumber_data')->nullable()->comment('Sumber data');
            $table->integer('tahun')->default(2025);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_sampah');
    }
};
