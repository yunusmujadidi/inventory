<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Supplier;
use App\Models\BarangMasuk;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierBarangMasuksTest extends TestCase
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
    public function it_gets_supplier_barang_masuks()
    {
        $supplier = Supplier::factory()->create();
        $barangMasuks = BarangMasuk::factory()
            ->count(2)
            ->create([
                'supplier_id' => $supplier->id,
            ]);

        $response = $this->getJson(
            route('api.suppliers.barang-masuks.index', $supplier)
        );

        $response->assertOk()->assertSee($barangMasuks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_supplier_barang_masuks()
    {
        $supplier = Supplier::factory()->create();
        $data = BarangMasuk::factory()
            ->make([
                'supplier_id' => $supplier->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.suppliers.barang-masuks.store', $supplier),
            $data
        );

        $this->assertDatabaseHas('barang_masuks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barangMasuk = BarangMasuk::latest('id')->first();

        $this->assertEquals($supplier->id, $barangMasuk->supplier_id);
    }
}
