<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BarangKeluar;

use App\Models\Lokasi;
use App\Models\Barang;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangKeluarTest extends TestCase
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
    public function it_gets_barang_keluars_list()
    {
        $barangKeluars = BarangKeluar::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.barang-keluars.index'));

        $response->assertOk()->assertSee($barangKeluars[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_barang_keluar()
    {
        $data = BarangKeluar::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.barang-keluars.store'), $data);

        $this->assertDatabaseHas('barang_keluars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_barang_keluar()
    {
        $barangKeluar = BarangKeluar::factory()->create();

        $lokasi = Lokasi::factory()->create();
        $barang = Barang::factory()->create();

        $data = [
            'tanggal_keluar' => $this->faker->dateTime,
            'jumlah_keluar' => $this->faker->randomNumber,
            'lokasi_id' => $lokasi->id,
            'barang_id' => $barang->id,
        ];

        $response = $this->putJson(
            route('api.barang-keluars.update', $barangKeluar),
            $data
        );

        $data['id'] = $barangKeluar->id;

        $this->assertDatabaseHas('barang_keluars', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_barang_keluar()
    {
        $barangKeluar = BarangKeluar::factory()->create();

        $response = $this->deleteJson(
            route('api.barang-keluars.destroy', $barangKeluar)
        );

        $this->assertDeleted($barangKeluar);

        $response->assertNoContent();
    }
}
