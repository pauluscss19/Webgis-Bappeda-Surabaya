<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel geo_layers menyimpan semua fitur GeoJSON.
     * Setiap baris = 1 Feature dari GeoJSON FeatureCollection.
     *
     * Kolom:
     * - layer_key   : kunci layer (misal 'CCTV_EKSISTING', 'DAMKAR', dll)
     * - name        : nama fitur (untuk pencarian cepat)
     * - feature_id  : ID unik fitur di dalam layer (opsional)
     * - geometry    : JSON geometry (langsung bisa dipakai Leaflet)
     * - properties  : JSON seluruh properti fitur
     */
    public function up(): void
    {
        Schema::create('geo_layers', function (Blueprint $table) {
            $table->id();
            $table->string('layer_key', 50)->index();       // e.g. 'DAMKAR', 'CCTV_EKSISTING'
            $table->string('name', 255)->nullable();          // nama fitur (denormalisasi utk search)
            $table->string('feature_id', 100)->nullable();    // ID asli dari GeoJSON
            $table->json('geometry');                          // GeoJSON geometry object
            $table->json('properties')->nullable();           // seluruh properties
            $table->timestamps();

            // Index untuk pencarian cepat per layer
            $table->index(['layer_key', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geo_layers');
    }
};
