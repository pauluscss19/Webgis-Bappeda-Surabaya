<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Kompor Krematorium
        Schema::create('kompor_krematoriums', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->string('kondisi', 50)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();
        });

        // 2. Tabel Pegawai Krematorium
        Schema::create('pegawai_krematoriums', function (Blueprint $table) {
            $table->id();
            $table->integer('no'); // Nomor urut asli
            $table->string('nama_pegawai', 100);
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('nik', 20)->nullable(); // String agar aman dari scientific notation
            $table->string('status', 50)->nullable();
            $table->string('lokasi_kerja', 50)->nullable();
            $table->timestamps();
        });

        // 3. Tabel Catatan Jabatan
        Schema::create('catatan_jabatan_krematoriums', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan', 100);
            $table->integer('jumlah_orang');
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_jabatan_krematoriums');
        Schema::dropIfExists('pegawai_krematoriums');
        Schema::dropIfExists('kompor_krematoriums');
    }
};