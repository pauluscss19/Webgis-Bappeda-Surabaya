<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoLayer extends Model
{
    protected $table = 'geo_layers';

    protected $fillable = [
        'layer_key',
        'name',
        'feature_id',
        'geometry',
        'properties',
    ];

    protected $casts = [
        'geometry'   => 'array',
        'properties' => 'array',
    ];

    /**
     * Scope: filter berdasarkan layer_key
     */
    public function scopeForLayer($query, string $layerKey)
    {
        return $query->where('layer_key', $layerKey);
    }

    /**
     * Konversi row ke format GeoJSON Feature
     */
    public function toGeoJsonFeature(): array
    {
        return [
            'type'       => 'Feature',
            'id'         => $this->feature_id ?? $this->id,
            'geometry'   => $this->geometry,
            'properties' => $this->properties ?? new \stdClass(),
        ];
    }

    /**
     * Konversi koleksi GeoLayer ke FeatureCollection
     */
    public static function toFeatureCollection($models): array
    {
        $features = [];
        foreach ($models as $model) {
            $features[] = $model->toGeoJsonFeature();
        }

        return [
            'type'     => 'FeatureCollection',
            'features' => $features,
        ];
    }
}
