<?php

namespace App\Http\Controllers;

use App\Models\CustomLayer;
use App\Models\GeoLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class CustomLayerController extends Controller
{
    /**
     * GET /custom-layers — Daftar semua custom layer
     */
    public function index(Request $request)
    {
        $query = CustomLayer::with('user')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('original_filename', 'LIKE', "%{$search}%");
            });
        }

        $layers = $query->paginate(15)->withQueryString();

        $summary = [
            'total_layers'   => CustomLayer::count(),
            'total_active'   => CustomLayer::where('is_active', true)->count(),
            'total_features' => CustomLayer::sum('feature_count'),
            'total_points'   => CustomLayer::where('geometry_type', 'point')->count(),
            'total_lines'    => CustomLayer::where('geometry_type', 'line')->count(),
            'total_polygons' => CustomLayer::where('geometry_type', 'polygon')->count(),
        ];

        return view('pages.crud.custom-layers.index', compact('layers', 'summary'));
    }

    /**
     * GET /custom-layers/create — Form upload GeoJSON
     */
    public function create()
    {
        return view('pages.crud.custom-layers.create');
    }

    /**
     * POST /custom-layers — Proses upload + simpan
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'color'       => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'category'    => 'required|string|in:infrastruktur,pendidikan,persampahan,fasilitas,demografi,pompa_saluran',
            'geojson_file'=> 'required|file|max:10240|mimes:json,geojson,txt',
        ], [
            'name.required'         => 'Nama layer wajib diisi.',
            'category.required'     => 'Kategori wajib dipilih.',
            'category.in'           => 'Kategori tidak valid.',
            'color.regex'           => 'Warna harus berformat hex (#RRGGBB).',
            'geojson_file.required' => 'File GeoJSON wajib di-upload.',
            'geojson_file.max'      => 'Ukuran file maksimal 10 MB.',
        ]);

        // Parse file GeoJSON
        $file    = $request->file('geojson_file');
        $content = file_get_contents($file->getRealPath());
        $data    = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withInput()->withErrors(['geojson_file' => 'File bukan JSON yang valid.']);
        }

        // Normalisasi ke FeatureCollection
        $features = $this->extractFeatures($data);

        if (empty($features)) {
            return back()->withInput()->withErrors(['geojson_file' => 'Tidak ditemukan fitur GeoJSON yang valid di file ini.']);
        }

        if (count($features) > 5000) {
            return back()->withInput()->withErrors(['geojson_file' => 'Maksimal 5.000 fitur per file. File ini memiliki ' . count($features) . ' fitur.']);
        }

        DB::beginTransaction();
        try {
            // Buat record custom_layer
            $customLayer = CustomLayer::create([
                'layer_key'         => 'CUSTOM_TEMP',  // akan di-update setelah dapat ID
                'name'              => $request->input('name'),
                'description'       => $request->input('description'),
                'color'             => $request->input('color'),
                'category'          => $request->input('category'),
                'geometry_type'     => CustomLayer::detectGeometryType($features),
                'feature_count'     => count($features),
                'original_filename' => $file->getClientOriginalName(),
                'user_id'           => Auth::id(),
            ]);

            // Update layer_key dengan ID
            $layerKey = CustomLayer::generateLayerKey($customLayer->id);
            $customLayer->update(['layer_key' => $layerKey]);

            // Simpan features ke tabel geo_layers
            $this->storeFeatures($features, $layerKey);

            DB::commit();

            return redirect()->route('custom-layers.index')
                ->with('success', "Layer \"{$customLayer->name}\" berhasil di-upload dengan {$customLayer->feature_count} fitur!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['geojson_file' => 'Gagal menyimpan: ' . $e->getMessage()]);
        }
    }

    /**
     * GET /custom-layers/{id}/edit — Form edit metadata
     */
    public function edit(CustomLayer $customLayer)
    {
        return view('pages.crud.custom-layers.edit', compact('customLayer'));
    }

    /**
     * PUT /custom-layers/{id} — Update metadata
     */
    public function update(Request $request, CustomLayer $customLayer)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'color'       => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'category'    => 'required|string|in:infrastruktur,pendidikan,persampahan,fasilitas,demografi,pompa_saluran',
            'is_active'   => 'sometimes|boolean',
        ]);

        $customLayer->update([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'color'       => $request->input('color'),
            'category'    => $request->input('category'),
            'is_active'   => $request->boolean('is_active', $customLayer->is_active),
        ]);

        return redirect()->route('custom-layers.index')
            ->with('success', "Layer \"{$customLayer->name}\" berhasil diperbarui.");
    }

    /**
     * DELETE /custom-layers/{id} — Hapus layer + semua fitur
     */
    public function destroy(CustomLayer $customLayer)
    {
        $name = $customLayer->name;

        DB::beginTransaction();
        try {
            // Hapus fitur dari geo_layers
            $customLayer->deleteGeoFeatures();
            // Hapus metadata
            $customLayer->delete();
            DB::commit();

            return redirect()->route('custom-layers.index')
                ->with('success', "Layer \"{$name}\" beserta semua fiturnya berhasil dihapus.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menghapus: ' . $e->getMessage()]);
        }
    }

    /**
     * PATCH /custom-layers/{id}/toggle — Toggle aktif/non-aktif
     */
    public function toggle(CustomLayer $customLayer)
    {
        $customLayer->update(['is_active' => !$customLayer->is_active]);

        return redirect()->route('custom-layers.index')
            ->with('success', "Layer \"{$customLayer->name}\" " . ($customLayer->is_active ? 'diaktifkan' : 'dinonaktifkan') . '.');
    }

    /**
     * POST /custom-layers/{custom_layer}/add-point — Tambah titik atau area kustom baru ke layer
     */
    public function addPoint(Request $request, CustomLayer $customLayer): JsonResponse
    {
        $request->validate([
            'lat'        => 'required_without:geometry|numeric',
            'lng'        => 'required_without:geometry|numeric',
            'geometry'   => 'required_without:lat,lng|array',
            'properties' => 'required|array',
        ]);

        $properties = $request->input('properties');
        $geometry = $request->input('geometry');

        if ($geometry) {
            $geomType = $geometry['type'] ?? 'Point';
        } else {
            $lat = (float) $request->input('lat');
            $lng = (float) $request->input('lng');
            $geometry = [
                'type'        => 'Point',
                'coordinates' => [$lng, $lat]
            ];
            $geomType = 'Point';
        }

        // Cari field nama dari properties kustom
        $name = null;
        foreach (['Name', 'name', 'NAMA', 'Nama', 'nama', 'NAMA SEKOL', 'label', 'title'] as $field) {
            if (!empty($properties[$field])) {
                $name = (string) $properties[$field];
                break;
            }
        }
        
        // Jika tidak ditemukan field nama standar, gunakan nilai pertama dari properties atau fallback
        if (empty($name)) {
            $name = !empty($properties) ? (string) reset($properties) : ($geomType === 'Point' ? 'Titik Baru' : 'Area Baru');
        }

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $prefix = $geomType === 'Point' ? 'custom_pt_' : ($geomType === 'Polygon' ? 'custom_pl_' : 'custom_ft_');
            $featureId = $prefix . time() . '_' . rand(100, 999);
            
            GeoLayer::create([
                'layer_key'  => $customLayer->layer_key,
                'name'       => $name,
                'feature_id' => $featureId,
                'geometry'   => $geometry,
                'properties' => $properties
            ]);

            // Update feature_count
            $customLayer->increment('feature_count');

            // Update geometry_type jika tidak sejalan
            $geomTypeLower = strtolower($geomType);
            if ($customLayer->geometry_type !== $geomTypeLower) {
                if ($customLayer->geometry_type === 'point' || $customLayer->geometry_type === 'polygon') {
                    $customLayer->update(['geometry_type' => 'mixed']);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'success' => true,
                'message' => ($geomType === 'Point' ? 'Titik' : 'Area') . ' kustom berhasil disimpan ke database!',
                'feature' => [
                    'type'       => 'Feature',
                    'id'         => $featureId,
                    'geometry'   => $geometry,
                    'properties' => $properties
                ],
                'new_count' => $customLayer->feature_count,
                'geometry_type' => $customLayer->geometry_type
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan fitur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /custom-layers/{custom_layer}/features/{feature_id} — Update fitur spasial (koordinat & properties)
     */
    public function updateFeature(Request $request, CustomLayer $customLayer, string $featureId): JsonResponse
    {
        $request->validate([
            'lat'        => 'nullable|numeric',
            'lng'        => 'nullable|numeric',
            'geometry'   => 'nullable|array',
            'properties' => 'required|array',
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $feature = GeoLayer::where('layer_key', $customLayer->layer_key)
                ->where('feature_id', $featureId)
                ->first();

            if (!$feature) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fitur tidak ditemukan di database.'
                ], 404);
            }

            // Extract geometry
            if ($request->has('geometry')) {
                $geometry = $request->input('geometry');
            } elseif ($request->has('lat') && $request->has('lng')) {
                $geometry = [
                    'type'        => 'Point',
                    'coordinates' => [(float) $request->input('lng'), (float) $request->input('lat')]
                ];
            } else {
                $geometry = $feature->geometry;
            }

            // Extract name
            $properties = $request->input('properties');
            $name = null;
            foreach (['Name', 'name', 'NAMA', 'Nama', 'nama', 'NAMA SEKOL', 'label', 'title'] as $field) {
                if (!empty($properties[$field])) {
                    $name = (string) $properties[$field];
                    break;
                }
            }
            if (empty($name)) {
                $name = !empty($properties) ? (string) reset($properties) : $feature->name;
            }

            $feature->update([
                'name'       => $name,
                'geometry'   => $geometry,
                'properties' => $properties,
            ]);

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Fitur berhasil diperbarui!',
                'feature' => $feature->toGeoJsonFeature()
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui fitur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /custom-layers/{custom_layer}/features/{feature_id} — Hapus fitur spasial
     */
    public function deleteFeature(CustomLayer $customLayer, string $featureId): JsonResponse
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $feature = GeoLayer::where('layer_key', $customLayer->layer_key)
                ->where('feature_id', $featureId)
                ->first();

            if (!$feature) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fitur tidak ditemukan di database.'
                ], 404);
            }

            $feature->delete();

            // Decrement feature count
            if ($customLayer->feature_count > 0) {
                $customLayer->decrement('feature_count');
            }

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Fitur berhasil dihapus dari database!',
                'new_count' => $customLayer->feature_count
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus fitur: ' . $e->getMessage()
            ], 500);
        }
    }

    // ──────────────────────────────────────────────────
    // API Endpoints (untuk halaman peta)
    // ──────────────────────────────────────────────────

    /**
     * GET /api/custom-layers — Daftar custom layer aktif (untuk peta)
     */
    public function apiIndex(): JsonResponse
    {
        $layers = CustomLayer::where('is_active', true)
            ->select(['id', 'layer_key', 'name', 'description', 'color', 'category', 'geometry_type', 'feature_count'])
            ->orderBy('name')
            ->get();

        return response()->json(['layers' => $layers]);
    }

    // ──────────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────────

    /**
     * Ekstrak array features dari berbagai format GeoJSON
     */
    private function extractFeatures(array $data): array
    {
        if (isset($data['type'])) {
            if ($data['type'] === 'FeatureCollection' && isset($data['features'])) {
                return array_filter($data['features'], fn($f) => isset($f['geometry']));
            }
            if ($data['type'] === 'Feature' && isset($data['geometry'])) {
                return [$data];
            }
            if ($data['type'] === 'GeometryCollection' && isset($data['geometries'])) {
                return array_map(fn($g, $i) => [
                    'type'       => 'Feature',
                    'geometry'   => $g,
                    'properties' => ['id' => $i],
                ], $data['geometries'], array_keys($data['geometries']));
            }
            // Raw geometry (Point, LineString, Polygon, dll)
            if (isset($data['coordinates'])) {
                return [[
                    'type'       => 'Feature',
                    'geometry'   => $data,
                    'properties' => ['Name' => 'Feature 1'],
                ]];
            }
        }

        return [];
    }

    /**
     * Simpan features ke tabel geo_layers secara batch
     */
    private function storeFeatures(array $features, string $layerKey): void
    {
        // Gunakan chunk size yang jauh lebih kecil (25) untuk menghindari error 
        // "MySQL server has gone away" (max_allowed_packet exceeded) saat insert polygon besar
        $chunks = array_chunk($features, 25);
        $now    = now();

        foreach ($chunks as $chunk) {
            $rows = [];
            foreach ($chunk as $index => $feature) {
                // Cari field nama dari properties
                $props = $feature['properties'] ?? [];
                $name  = null;
                foreach (['Name', 'name', 'NAMA', 'Nama', 'nama', 'NAMA SEKOL', 'label', 'title'] as $field) {
                    if (!empty($props[$field])) {
                        $name = (string) $props[$field];
                        break;
                    }
                }

                $rows[] = [
                    'layer_key'   => $layerKey,
                    'name'        => $name,
                    'feature_id'  => $feature['id'] ?? (string) $index,
                    'geometry'    => json_encode($feature['geometry']),
                    'properties'  => json_encode($feature['properties'] ?? new \stdClass()),
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }
            GeoLayer::insert($rows);
        }
    }
}
