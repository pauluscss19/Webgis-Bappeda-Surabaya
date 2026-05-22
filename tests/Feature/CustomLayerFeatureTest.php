<?php

namespace Tests\Feature;

use App\Models\CustomLayer;
use App\Models\GeoLayer;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomLayerFeatureTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $customLayer;

    protected function setUp(): void
    {
        parent::setUp();

        // Create or get user
        $this->user = User::firstOrCreate(
            ['email' => 'testuser@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Create custom layer metadata
        $this->customLayer = CustomLayer::create([
            'layer_key' => 'CUSTOM_TEST_' . rand(1000, 9999),
            'name' => 'Layer Uji Coba',
            'description' => 'Layer untuk testing',
            'color' => '#ff0000',
            'category' => 'infrastruktur',
            'geometry_type' => 'point',
            'feature_count' => 0,
            'original_filename' => 'test.geojson',
            'user_id' => $this->user->id,
            'is_active' => true,
        ]);
    }

    public function test_add_point_feature(): void
    {
        $this->actingAs($this->user);

        $payload = [
            'lat' => -7.25,
            'lng' => 112.75,
            'properties' => [
                'nama' => 'Titik Tes A',
                'keterangan' => 'Keterangan A',
            ]
        ];

        $response = $this->postJson(route('custom-layers.add-point', $this->customLayer->id), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'new_count' => 1,
            'geometry_type' => 'point'
        ]);

        $this->assertDatabaseHas('geo_layers', [
            'layer_key' => $this->customLayer->layer_key,
            'name' => 'Titik Tes A',
        ]);
    }

    public function test_add_polygon_feature(): void
    {
        $this->actingAs($this->user);

        $polygonCoords = [
            [
                [112.74, -7.26],
                [112.75, -7.26],
                [112.75, -7.27],
                [112.74, -7.27],
                [112.74, -7.26]
            ]
        ];

        $payload = [
            'geometry' => [
                'type' => 'Polygon',
                'coordinates' => $polygonCoords
            ],
            'properties' => [
                'nama' => 'Area Tes B',
                'deskripsi' => 'Deskripsi B',
            ]
        ];

        $response = $this->postJson(route('custom-layers.add-point', $this->customLayer->id), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'new_count' => 1,
            'geometry_type' => 'mixed'
        ]);

        $this->assertDatabaseHas('geo_layers', [
            'layer_key' => $this->customLayer->layer_key,
            'name' => 'Area Tes B',
        ]);
    }

    public function test_update_feature(): void
    {
        $this->actingAs($this->user);

        $featureId = 'custom_pt_test_123';
        $feature = GeoLayer::create([
            'layer_key' => $this->customLayer->layer_key,
            'name' => 'Titik Lama',
            'feature_id' => $featureId,
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [112.74, -7.25]
            ],
            'properties' => [
                'nama' => 'Titik Lama',
                'info' => 'Lama'
            ]
        ]);

        $this->customLayer->update(['feature_count' => 1]);

        $updatePayload = [
            'lat' => -7.26,
            'lng' => 112.76,
            'properties' => [
                'nama' => 'Titik Baru Terupdate',
                'info' => 'Baru'
            ]
        ];

        $response = $this->putJson(route('custom-layers.update-feature', [$this->customLayer->id, $featureId]), $updatePayload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'feature' => [
                'id' => $featureId,
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [112.76, -7.26]
                ],
                'properties' => [
                    'nama' => 'Titik Baru Terupdate',
                    'info' => 'Baru'
                ]
            ]
        ]);

        $this->assertDatabaseHas('geo_layers', [
            'layer_key' => $this->customLayer->layer_key,
            'name' => 'Titik Baru Terupdate',
        ]);
    }

    public function test_delete_feature(): void
    {
        $this->actingAs($this->user);

        $featureId1 = 'custom_pt_test_1';
        $featureId2 = 'custom_pt_test_2';

        GeoLayer::create([
            'layer_key' => $this->customLayer->layer_key,
            'name' => 'Titik Satu',
            'feature_id' => $featureId1,
            'geometry' => ['type' => 'Point', 'coordinates' => [112.74, -7.25]],
            'properties' => ['nama' => 'Titik Satu']
        ]);

        GeoLayer::create([
            'layer_key' => $this->customLayer->layer_key,
            'name' => 'Titik Dua',
            'feature_id' => $featureId2,
            'geometry' => ['type' => 'Point', 'coordinates' => [112.75, -7.26]],
            'properties' => ['nama' => 'Titik Dua']
        ]);

        $this->customLayer->update(['feature_count' => 2]);

        $response = $this->deleteJson(route('custom-layers.delete-feature', [$this->customLayer->id, $featureId1]));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'new_count' => 1
        ]);

        $this->assertDatabaseMissing('geo_layers', [
            'layer_key' => $this->customLayer->layer_key,
            'feature_id' => $featureId1,
        ]);

        $this->assertDatabaseHas('geo_layers', [
            'layer_key' => $this->customLayer->layer_key,
            'feature_id' => $featureId2,
        ]);
    }
}
