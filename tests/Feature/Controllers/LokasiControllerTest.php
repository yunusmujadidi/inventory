<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Lokasi;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LokasiControllerTest extends TestCase
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
    public function it_displays_index_view_with_lokasis()
    {
        $lokasis = Lokasi::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lokasis.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lokasis.index')
            ->assertViewHas('lokasis');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lokasi()
    {
        $response = $this->get(route('lokasis.create'));

        $response->assertOk()->assertViewIs('app.lokasis.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lokasi()
    {
        $data = Lokasi::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lokasis.store'), $data);

        $this->assertDatabaseHas('lokasis', $data);

        $lokasi = Lokasi::latest('id')->first();

        $response->assertRedirect(route('lokasis.edit', $lokasi));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lokasi()
    {
        $lokasi = Lokasi::factory()->create();

        $response = $this->get(route('lokasis.show', $lokasi));

        $response
            ->assertOk()
            ->assertViewIs('app.lokasis.show')
            ->assertViewHas('lokasi');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lokasi()
    {
        $lokasi = Lokasi::factory()->create();

        $response = $this->get(route('lokasis.edit', $lokasi));

        $response
            ->assertOk()
            ->assertViewIs('app.lokasis.edit')
            ->assertViewHas('lokasi');
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

        $response = $this->put(route('lokasis.update', $lokasi), $data);

        $data['id'] = $lokasi->id;

        $this->assertDatabaseHas('lokasis', $data);

        $response->assertRedirect(route('lokasis.edit', $lokasi));
    }

    /**
     * @test
     */
    public function it_deletes_the_lokasi()
    {
        $lokasi = Lokasi::factory()->create();

        $response = $this->delete(route('lokasis.destroy', $lokasi));

        $response->assertRedirect(route('lokasis.index'));

        $this->assertDeleted($lokasi);
    }
}
