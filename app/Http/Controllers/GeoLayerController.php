<?php

namespace App\Http\Controllers;

use App\Models\GeoLayer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeoLayerController extends Controller
{
    /**
     * GET /api/geo-layer/{layerKey}
     * 
     * Mengembalikan seluruh fitur layer dalam format GeoJSON FeatureCollection.
     * Response di-cache browser selama 10 menit (Cache-Control header).
     */
    public function show(string $layerKey): JsonResponse
    {
        $features = GeoLayer::forLayer($layerKey)
            ->select(['id', 'feature_id', 'geometry', 'properties'])
            ->get();

        if ($features->isEmpty()) {
            return response()->json([
                'type'     => 'FeatureCollection',
                'features' => [],
            ], 200);
        }

        $featureCollection = GeoLayer::toFeatureCollection($features);

        return response()->json($featureCollection)
            ->header('Cache-Control', 'public, max-age=600');  // cache 10 menit
    }

    /**
     * GET /api/geo-layers
     * 
     * Daftar semua layer yang tersedia beserta jumlah fitur.
     */
    public function index(): JsonResponse
    {
        $layers = GeoLayer::query()
            ->selectRaw('layer_key, COUNT(*) as feature_count')
            ->groupBy('layer_key')
            ->orderBy('layer_key')
            ->get();

        return response()->json([
            'layers' => $layers,
        ]);
    }

    /**
     * GET /api/geo-layer/{layerKey}/search?q=...
     * 
     * Pencarian fitur berdasarkan nama (kolom name).
     */
    public function search(string $layerKey, Request $request): JsonResponse
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'type'     => 'FeatureCollection',
                'features' => [],
            ]);
        }

        $features = GeoLayer::forLayer($layerKey)
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(50)
            ->get();

        return response()->json(GeoLayer::toFeatureCollection($features));
    }
}
