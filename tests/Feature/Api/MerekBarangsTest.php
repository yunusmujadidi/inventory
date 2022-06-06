<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Merek;
use App\Models\Barang;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MerekBarangsTest extends TestCase
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
    public function it_gets_merek_barangs()
    {
        $merek = Merek::factory()->create();
        $barangs = Barang::factory()
            ->count(2)
            ->create([
                'merek_id' => $merek->id,
            ]);

        $response = $this->getJson(route('api.mereks.barangs.index', $merek));

        $response->assertOk()->assertSee($barangs[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_merek_barangs()
    {
        $merek = Merek::factory()->create();
        $data = Barang::factory()
            ->make([
                'merek_id' => $merek->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.mereks.barangs.store', $merek),
            $data
        );

        $this->assertDatabaseHas('barangs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barang = Barang::latest('id')->first();

        $this->assertEquals($merek->id, $barang->merek_id);
    }
}
