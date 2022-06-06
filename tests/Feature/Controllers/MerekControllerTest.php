<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Merek;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MerekControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_mereks()
    {
        $mereks = Merek::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('mereks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.mereks.index')
            ->assertViewHas('mereks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_merek()
    {
        $response = $this->get(route('mereks.create'));

        $response->assertOk()->assertViewIs('app.mereks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_merek()
    {
        $data = Merek::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('mereks.store'), $data);

        $this->assertDatabaseHas('mereks', $data);

        $merek = Merek::latest('id')->first();

        $response->assertRedirect(route('mereks.edit', $merek));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_merek()
    {
        $merek = Merek::factory()->create();

        $response = $this->get(route('mereks.show', $merek));

        $response
            ->assertOk()
            ->assertViewIs('app.mereks.show')
            ->assertViewHas('merek');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_merek()
    {
        $merek = Merek::factory()->create();

        $response = $this->get(route('mereks.edit', $merek));

        $response
            ->assertOk()
            ->assertViewIs('app.mereks.edit')
            ->assertViewHas('merek');
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

        $response = $this->put(route('mereks.update', $merek), $data);

        $data['id'] = $merek->id;

        $this->assertDatabaseHas('mereks', $data);

        $response->assertRedirect(route('mereks.edit', $merek));
    }

    /**
     * @test
     */
    public function it_deletes_the_merek()
    {
        $merek = Merek::factory()->create();

        $response = $this->delete(route('mereks.destroy', $merek));

        $response->assertRedirect(route('mereks.index'));

        $this->assertDeleted($merek);
    }
}
