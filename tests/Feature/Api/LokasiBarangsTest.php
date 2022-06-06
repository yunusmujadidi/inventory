<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lokasi;
use App\Models\Barang;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LokasiBarangsTest extends TestCase
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
    public function it_gets_lokasi_barangs()
    {
        $lokasi = Lokasi::factory()->create();
        $barangs = Barang::factory()
            ->count(2)
            ->create([
                'lokasi_id' => $lokasi->id,
            ]);

        $response = $this->getJson(route('api.lokasis.barangs.index', $lokasi));

        $response->assertOk()->assertSee($barangs[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_lokasi_barangs()
    {
        $lokasi = Lokasi::factory()->create();
        $data = Barang::factory()
            ->make([
                'lokasi_id' => $lokasi->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.lokasis.barangs.store', $lokasi),
            $data
        );

        $this->assertDatabaseHas('barangs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barang = Barang::latest('id')->first();

        $this->assertEquals($lokasi->id, $barang->lokasi_id);
    }
}
