<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demografi_rw', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan', 100)->index();
            $table->string('kelurahan', 100)->index();
            $table->string('rw', 50)->index(); // RW can be string/number (e.g., '1', '01', or 'NaN')
            $table->string('gabung', 255)->nullable();
            $table->integer('jumlah_kk')->default(0);
            $table->integer('jumlah_jiwa')->default(0);
            $table->timestamps();

            // Unique index to prevent duplicate entries
            $table->unique(['kecamatan', 'kelurahan', 'rw']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografi_rw');
    }
};
