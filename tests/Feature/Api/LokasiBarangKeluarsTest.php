<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lokasi;
use App\Models\BarangKeluar;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LokasiBarangKeluarsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_lokasi_barang_keluars()
    {
        $lokasi = Lokasi::factory()->create();
        $barangKeluars = BarangKeluar::factory()
            ->count(2)
            ->create([
                'lokasi_id' => $lokasi->id,
            ]);

        $response = $this->getJson(
            route('api.lokasis.barang-keluars.index', $lokasi)
        );

        $response->assertOk()->assertSee($barangKeluars[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_lokasi_barang_keluars()
    {
        $lokasi = Lokasi::factory()->create();
        $data = BarangKeluar::factory()
            ->make([
                'lokasi_id' => $lokasi->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.lokasis.barang-keluars.store', $lokasi),
            $data
        );

        $this->assertDatabaseHas('barang_keluars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barangKeluar = BarangKeluar::latest('id')->first();

        $this->assertEquals($lokasi->id, $barangKeluar->lokasi_id);
    }
}
