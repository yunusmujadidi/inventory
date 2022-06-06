<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Lokasi;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LokasiTest extends TestCase
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
    public function it_gets_lokasis_list()
    {
        $lokasis = Lokasi::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.lokasis.index'));

        $response->assertOk()->assertSee($lokasis[0]->lokasi);
    }

    /**
     * @test
     */
    public function it_stores_the_lokasi()
    {
        $data = Lokasi::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.lokasis.store'), $data);

        $this->assertDatabaseHas('lokasis', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_lokasi()
    {
        $lokasi = Lokasi::factory()->create();

        $data = [
            'lokasi' => $this->faker->word(255),
        ];

        $response = $this->putJson(route('api.lokasis.update', $lokasi), $data);

        $data['id'] = $lokasi->id;

        $this->assertDatabaseHas('lokasis', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_lokasi()
    {
        $lokasi = Lokasi::factory()->create();

        $response = $this->deleteJson(route('api.lokasis.destroy', $lokasi));

        $this->assertDeleted($lokasi);

        $response->assertNoContent();
    }
}
