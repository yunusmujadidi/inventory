<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Kategori;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriTest extends TestCase
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
    public function it_gets_kategoris_list()
    {
        $kategoris = Kategori::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.kategoris.index'));

        $response->assertOk()->assertSee($kategoris[0]->kategori);
    }

    /**
     * @test
     */
    public function it_stores_the_kategori()
    {
        $data = Kategori::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.kategoris.store'), $data);

        $this->assertDatabaseHas('kategoris', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_kategori()
    {
        $kategori = Kategori::factory()->create();

        $data = [
            'kategori' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.kategoris.update', $kategori),
            $data
        );

        $data['id'] = $kategori->id;

        $this->assertDatabaseHas('kategoris', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_kategori()
    {
        $kategori = Kategori::factory()->create();

        $response = $this->deleteJson(
            route('api.kategoris.destroy', $kategori)
        );

        $this->assertDeleted($kategori);

        $response->assertNoContent();
    }
}
