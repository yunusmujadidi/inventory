<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;
use App\Models\BarangMasuk;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangBarangMasuksTest extends TestCase
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
    public function it_gets_barang_barang_masuks()
    {
        $barang = Barang::factory()->create();
        $barangMasuks = BarangMasuk::factory()
            ->count(2)
            ->create([
                'barang_id' => $barang->id,
            ]);

        $response = $this->getJson(
            route('api.barangs.barang-masuks.index', $barang)
        );

        $response->assertOk()->assertSee($barangMasuks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_barang_barang_masuks()
    {
        $barang = Barang::factory()->create();
        $data = BarangMasuk::factory()
            ->make([
                'barang_id' => $barang->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.barangs.barang-masuks.store', $barang),
            $data
        );

        $this->assertDatabaseHas('barang_masuks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barangMasuk = BarangMasuk::latest('id')->first();

        $this->assertEquals($barang->id, $barangMasuk->barang_id);
    }
}
