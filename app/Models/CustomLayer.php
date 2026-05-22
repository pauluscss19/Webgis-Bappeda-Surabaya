<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomLayer extends Model
{
    protected $fillable = [
        'layer_key',
        'name',
        'description',
        'color',
        'category',
        'geometry_type',
        'feature_count',
        'original_filename',
        'user_id',
        'is_active',
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'feature_count' => 'integer',
    ];

    /**
     * User yang meng-upload layer ini
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate layer_key unik berdasarkan ID
     */
    public static function generateLayerKey(int $id): string
    {
        return 'CUSTOM_' . $id;
    }

    /**
     * Ambil semua fitur GeoJSON milik layer ini dari tabel geo_layers
     */
    public function geoFeatures()
    {
        return GeoLayer::forLayer($this->layer_key);
    }

    /**
     * Hapus semua fitur terkait di tabel geo_layers
     */
    public function deleteGeoFeatures(): int
    {
        return GeoLayer::where('layer_key', $this->layer_key)->delete();
    }

    /**
     * Deteksi tipe geometry dari GeoJSON features
     */
    public static function detectGeometryType(array $features): string
    {
        $types = [];
        foreach ($features as $feature) {
            $geomType = $feature['geometry']['type'] ?? '';
            if (str_contains($geomType, 'Point')) $types['point'] = true;
            elseif (str_contains($geomType, 'Line')) $types['line'] = true;
            elseif (str_contains($geomType, 'Polygon')) $types['polygon'] = true;
        }

        if (count($types) > 1) return 'mixed';
        return array_key_first($types) ?? 'mixed';
    }
}
