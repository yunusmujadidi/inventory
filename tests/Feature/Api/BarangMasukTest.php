<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BarangMasuk;

use App\Models\Barang;
use App\Models\Supplier;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangMasukTest extends TestCase
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
    public function it_gets_barang_masuks_list()
    {
        $barangMasuks = BarangMasuk::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.barang-masuks.index'));

        $response->assertOk()->assertSee($barangMasuks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_barang_masuk()
    {
        $data = BarangMasuk::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.barang-masuks.store'), $data);

        $this->assertDatabaseHas('barang_masuks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_barang_masuk()
    {
        $barangMasuk = BarangMasuk::factory()->create();

        $supplier = Supplier::factory()->create();
        $barang = Barang::factory()->create();

        $data = [
            'tanggal_masuk' => $this->faker->dateTime,
            'jumlah_masuk' => $this->faker->randomNumber,
            'supplier_id' => $supplier->id,
            'barang_id' => $barang->id,
        ];

        $response = $this->putJson(
            route('api.barang-masuks.update', $barangMasuk),
            $data
        );

        $data['id'] = $barangMasuk->id;

        $this->assertDatabaseHas('barang_masuks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_barang_masuk()
    {
        $barangMasuk = BarangMasuk::factory()->create();

        $response = $this->deleteJson(
            route('api.barang-masuks.destroy', $barangMasuk)
        );

        $this->assertDeleted($barangMasuk);

        $response->assertNoContent();
    }
}
