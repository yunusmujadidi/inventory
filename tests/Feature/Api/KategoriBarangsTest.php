<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriBarangsTest extends TestCase
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
    public function it_gets_kategori_barangs()
    {
        $kategori = Kategori::factory()->create();
        $barangs = Barang::factory()
            ->count(2)
            ->create([
                'kategori_id' => $kategori->id,
            ]);

        $response = $this->getJson(
            route('api.kategoris.barangs.index', $kategori)
        );

        $response->assertOk()->assertSee($barangs[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_kategori_barangs()
    {
        $kategori = Kategori::factory()->create();
        $data = Barang::factory()
            ->make([
                'kategori_id' => $kategori->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.kategoris.barangs.store', $kategori),
            $data
        );

        $this->assertDatabaseHas('barangs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barang = Barang::latest('id')->first();

        $this->assertEquals($kategori->id, $barang->kategori_id);
    }
}
