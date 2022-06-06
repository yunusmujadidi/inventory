<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;
use App\Models\BarangKeluar;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangBarangKeluarsTest extends TestCase
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
    public function it_gets_barang_barang_keluars()
    {
        $barang = Barang::factory()->create();
        $barangKeluars = BarangKeluar::factory()
            ->count(2)
            ->create([
                'barang_id' => $barang->id,
            ]);

        $response = $this->getJson(
            route('api.barangs.barang-keluars.index', $barang)
        );

        $response->assertOk()->assertSee($barangKeluars[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_barang_barang_keluars()
    {
        $barang = Barang::factory()->create();
        $data = BarangKeluar::factory()
            ->make([
                'barang_id' => $barang->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.barangs.barang-keluars.store', $barang),
            $data
        );

        $this->assertDatabaseHas('barang_keluars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barangKeluar = BarangKeluar::latest('id')->first();

        $this->assertEquals($barang->id, $barangKeluar->barang_id);
    }
}
