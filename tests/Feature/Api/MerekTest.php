<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Merek;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MerekTest extends TestCase
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
    public function it_gets_mereks_list()
    {
        $mereks = Merek::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.mereks.index'));

        $response->assertOk()->assertSee($mereks[0]->merek);
    }

    /**
     * @test
     */
    public function it_stores_the_merek()
    {
        $data = Merek::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.mereks.store'), $data);

        $this->assertDatabaseHas('mereks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_merek()
    {
        $merek = Merek::factory()->create();

        $data = [
            'merek' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.mereks.update', $merek), $data);

        $data['id'] = $merek->id;

        $this->assertDatabaseHas('mereks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_merek()
    {
        $merek = Merek::factory()->create();

        $response = $this->deleteJson(route('api.mereks.destroy', $merek));

        $this->assertDeleted($merek);

        $response->assertNoContent();
    }
}
