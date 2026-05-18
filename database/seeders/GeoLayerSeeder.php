<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoLayerSeeder extends Seeder
{
    /**
     * Mapping: layer_key => [file, nameField]
     * Diambil dari config.js agar konsisten.
     */
    private array $layerMap = [
        // INFRASTRUKTUR
        'CCTV_EKSISTING'         => ['file' => 'CCTV_EKSISTING.geojson',       'nameField' => 'Name'],
        'CCTV_RENCANA'           => ['file' => 'CCTV_RENCANA.geojson',         'nameField' => 'Name'],
        'TITIK_SAMPAH'           => ['file' => 'TITIK_SAMPAH.geojson',         'nameField' => 'Keterangan'],
        'TITIK_SAMPAH_RENCANA'   => ['file' => 'TITIK_SAMPAH_RENCANA.geojson', 'nameField' => 'Keterangan'],
        'DAMKAR'                 => ['file' => 'DAMKAR.geojson',               'nameField' => 'Pos_Ekst'],
        'MAKAM'                  => ['file' => 'MAKAM.geojson',                'nameField' => 'Nama_Lokas'],
        'FIBEROPTIK'             => ['file' => 'FiberOptic.json',              'nameField' => 'name'],
        // JARINGAN_JALAN di-skip (92MB, terlalu besar untuk PHP memory — tetap dilayani sebagai file statis)
        // 'JARINGAN_JALAN'      => ['file' => 'jaringan_jalan.geojson',       'nameField' => 'name'],

        // PENDIDIKAN
        'PAUD'                   => ['file' => 'paud.geojson',                 'nameField' => 'NAMA SEKOL'],
        'SD_MI'                  => ['file' => 'sd-mi.geojson',                'nameField' => 'NAMA SEKOL'],
        'SMP_MTS'                => ['file' => 'smp-mts.geojson',              'nameField' => 'NAMA SEKOL'],

        // PERSAMPAHAN & LINGKUNGAN
        'TPS3R'                  => ['file' => 'TPS3R_12.json',                'nameField' => 'name'],
        'TPS'                    => ['file' => 'TPS_191.json',                 'nameField' => 'name'],
        'RUTE_SAMPAH'            => ['file' => 'RUTE_PENGANGKUTAN_SAMPAH_HAMDALAH_SUJUD_SYUKUR.geojson', 'nameField' => 'Name'],
        'POINT_RUTE_SAMPAH'      => ['file' => 'POINT_RUTE_PENGANGKUTAN_SAMPAH_HAMDALAH_SUJUD_SYUKUR.json', 'nameField' => 'Name'],
        'RUKOM'                  => ['file' => 'Rukom_27.json',                'nameField' => 'Name'],

        // FASILITAS UMUM
        'DEKORASI_KOTA'          => ['file' => 'DekorasiKota.json',            'nameField' => 'Name'],

        // DEMOGRAFI
        'KEPADATAN_PENDUDUK'     => ['file' => 'Kepadatan_Penduduk.json',      'nameField' => 'DESA'],

        // POMPA & SALURAN AIR
        'AREA_RAYON'             => ['file' => 'Area_Rayon.json',              'nameField' => 'name'],
        'POMPA_AIR_7_RAYON'      => ['file' => 'Layer area Pompa Air 7 Rayon.json', 'nameField' => 'name'],
        'JARINGAN_PIPA_SALURAN'  => ['file' => 'Layer garis jaringan pipa & saluran air.json', 'nameField' => 'name'],
        'TITIK_POMPA_AIR'        => ['file' => 'Layer titik lokasi pompa air.json', 'nameField' => 'name'],
        'SALURAN_AIR'            => ['file' => 'Saluran_Air.json',             'nameField' => 'name'],

        // BATAS WILAYAH
        'KECAMATAN'              => ['file' => 'Kecamatan.geojson',            'nameField' => 'Name'],
        'KELURAHAN'              => ['file' => 'kelurahan.geojson',            'nameField' => 'K'],
        'BATAS_RW'               => ['file' => '13102025-BATAS_RW.json',       'nameField' => 'RW'],
    ];

    public function run(): void
    {
        // Naikkan memory limit untuk file besar (jaringan_jalan.geojson = ~96MB)
        ini_set('memory_limit', '512M');

        $this->command->info('🗺️  GeoLayer Seeder — Memulai impor GeoJSON ke database...');

        // Truncate tabel
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('geo_layers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Naikkan max_allowed_packet MySQL agar bisa INSERT geometri besar
        try {
            DB::statement("SET GLOBAL max_allowed_packet=67108864;"); // 64MB
            // Reconnect agar setting berlaku
            DB::reconnect();
        } catch (\Throwable $e) {
            $this->command->warn("  ⚠ Gagal set max_allowed_packet (mungkin bukan root): " . $e->getMessage());
        }

        $totalInserted = 0;
        // Batas ukuran file yang dianggap "besar" (50 MB)
        $largeFileThreshold = 50 * 1024 * 1024;

        foreach ($this->layerMap as $layerKey => $config) {
            $filePath  = public_path($config['file']);
            $nameField = $config['nameField'];

            if (!file_exists($filePath)) {
                $this->command->warn("  ⚠ SKIP: File tidak ditemukan — {$config['file']}");
                continue;
            }

            $fileSize = filesize($filePath);
            $sizeMb   = round($fileSize / 1024 / 1024, 1);
            $this->command->info("  📂 Membaca: {$config['file']} ({$sizeMb} MB)...");

            try {
                $raw = file_get_contents($filePath);
                $json = json_decode($raw, true);
                unset($raw); // Bebaskan memori

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->command->error("  ❌ JSON Error pada {$config['file']}: " . json_last_error_msg());
                    continue;
                }
            } catch (\Throwable $e) {
                $this->command->error("  ❌ Gagal membaca {$config['file']}: " . $e->getMessage());
                continue;
            }

            // Normalisasi ke FeatureCollection
            $features = $this->extractFeatures($json, $layerKey);
            unset($json); // Bebaskan memori JSON asli

            if (empty($features)) {
                $this->command->warn("  ⚠ Tidak ada features di {$config['file']}");
                continue;
            }

            // Insert batch (chunk 50 — kecil agar tidak kena max_allowed_packet)
            $rows    = [];
            $now     = now();
            $skipped = 0;

            foreach ($features as $index => $feature) {
                $props    = $feature['properties'] ?? [];
                $geometry = $feature['geometry'] ?? null;

                if (!$geometry) continue;

                $geometryJson   = json_encode($geometry);
                $propertiesJson = json_encode($props, JSON_UNESCAPED_UNICODE);

                // Skip jika geometri tunggal terlalu besar (>10MB — biasanya polygon sangat detail)
                if (strlen($geometryJson) > 10 * 1024 * 1024) {
                    $skipped++;
                    continue;
                }

                // Coba ambil nama dari beberapa field
                $name = $this->extractName($props, $nameField);

                // Ambil feature ID
                $featureId = $feature['id'] ?? ($props['Id'] ?? ($props['OID_'] ?? null));

                $rows[] = [
                    'layer_key'  => $layerKey,
                    'name'       => $name ? mb_substr($name, 0, 255) : null,
                    'feature_id' => $featureId !== null ? (string) $featureId : null,
                    'geometry'   => $geometryJson,
                    'properties' => $propertiesJson,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // Insert per chunk of 50
                if (count($rows) >= 50) {
                    try {
                        DB::table('geo_layers')->insert($rows);
                    } catch (\Throwable $e) {
                        // Fallback: insert satu per satu
                        foreach ($rows as $singleRow) {
                            try {
                                DB::table('geo_layers')->insert($singleRow);
                            } catch (\Throwable $innerE) {
                                $skipped++;
                            }
                        }
                    }
                    $totalInserted += count($rows);
                    $rows = [];
                }
            }

            // Sisa rows
            if (!empty($rows)) {
                try {
                    DB::table('geo_layers')->insert($rows);
                } catch (\Throwable $e) {
                    foreach ($rows as $singleRow) {
                        try {
                            DB::table('geo_layers')->insert($singleRow);
                        } catch (\Throwable $innerE) {
                            $skipped++;
                        }
                    }
                }
                $totalInserted += count($rows);
            }

            $count = $totalInserted;
            $skipMsg = $skipped > 0 ? " ({$skipped} fitur di-skip karena terlalu besar)" : '';
            $this->command->info("  ✅ {$layerKey}: diproses{$skipMsg}");

            // Bebaskan memori setelah setiap file
            unset($features, $rows);
            gc_collect_cycles();
        }

        $this->command->newLine();
        $this->command->info("🎉 Selesai! Total {$totalInserted} fitur GeoJSON berhasil diimpor ke tabel geo_layers.");
    }

    /**
     * Ekstrak features dari berbagai format GeoJSON.
     */
    private function extractFeatures(array $json, string $layerKey): array
    {
        // Sudah FeatureCollection
        if (($json['type'] ?? '') === 'FeatureCollection' && isset($json['features'])) {
            return $json['features'];
        }

        // GeometryCollection → konversi ke Features
        if (($json['type'] ?? '') === 'GeometryCollection' && isset($json['geometries'])) {
            return array_map(function ($geometry, $index) use ($layerKey) {
                return [
                    'type'       => 'Feature',
                    'id'         => $index,
                    'geometry'   => $geometry,
                    'properties' => ['id' => $index],
                ];
            }, $json['geometries'], array_keys($json['geometries']));
        }

        // Geometry tunggal
        if (isset($json['type'], $json['coordinates'])) {
            return [[
                'type'       => 'Feature',
                'id'         => 0,
                'geometry'   => $json,
                'properties' => [],
            ]];
        }

        return [];
    }

    /**
     * Coba ekstrak nama dari properties dengan fallback.
     */
    private function extractName(array $props, string $primaryField): ?string
    {
        // Coba primary field dulu
        if (!empty($props[$primaryField])) {
            return trim((string) $props[$primaryField]);
        }

        // Fallback ke field umum
        $fallbacks = ['Name', 'name', 'NAMA', 'Nama', 'NAMA SEKOL', 'Pos_Ekst', 'Nama_Lokas', 'K', 'RW', 'DESA', 'KELURAHAN'];
        foreach ($fallbacks as $field) {
            if (!empty($props[$field])) {
                return trim((string) $props[$field]);
            }
        }

        return null;
    }
}
