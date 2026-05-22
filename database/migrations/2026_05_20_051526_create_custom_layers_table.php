<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel custom_layers menyimpan metadata layer yang di-upload user.
     * Data fitur GeoJSON-nya tetap disimpan di tabel geo_layers (layer_key = CUSTOM_{id}).
     */
    public function up(): void
    {
        Schema::create('custom_layers', function (Blueprint $table) {
            $table->id();
            $table->string('layer_key', 50)->unique();          // e.g. 'CUSTOM_1', 'CUSTOM_2'
            $table->string('name', 255);                         // Nama tampilan layer
            $table->text('description')->nullable();             // Deskripsi opsional
            $table->string('color', 7)->default('#3b82f6');      // Hex color
            $table->enum('geometry_type', ['point', 'line', 'polygon', 'mixed'])->default('mixed');
            $table->unsignedInteger('feature_count')->default(0);
            $table->string('original_filename', 255);            // Nama file asli
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_layers');
    }
};
