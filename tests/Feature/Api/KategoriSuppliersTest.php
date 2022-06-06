<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Supplier;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriSuppliersTest extends TestCase
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
    public function it_gets_kategori_suppliers()
    {
        $kategori = Kategori::factory()->create();
        $suppliers = Supplier::factory()
            ->count(2)
            ->create([
                'kategori_id' => $kategori->id,
            ]);

        $response = $this->getJson(
            route('api.kategoris.suppliers.index', $kategori)
        );

        $response->assertOk()->assertSee($suppliers[0]->nama_supplier);
    }

    /**
     * @test
     */
    public function it_stores_the_kategori_suppliers()
    {
        $kategori = Kategori::factory()->create();
        $data = Supplier::factory()
            ->make([
                'kategori_id' => $kategori->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.kategoris.suppliers.store', $kategori),
            $data
        );

        $this->assertDatabaseHas('suppliers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $supplier = Supplier::latest('id')->first();

        $this->assertEquals($kategori->id, $supplier->kategori_id);
    }
}
