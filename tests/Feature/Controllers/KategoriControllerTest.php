<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Kategori;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriControllerTest extends TestCase
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
    public function it_displays_index_view_with_kategoris()
    {
        $kategoris = Kategori::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('kategoris.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.kategoris.index')
            ->assertViewHas('kategoris');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_kategori()
    {
        $response = $this->get(route('kategoris.create'));

        $response->assertOk()->assertViewIs('app.kategoris.create');
    }

    /**
     * @test
     */
    public function it_stores_the_kategori()
    {
        $data = Kategori::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('kategoris.store'), $data);

        $this->assertDatabaseHas('kategoris', $data);

        $kategori = Kategori::latest('id')->first();

        $response->assertRedirect(route('kategoris.edit', $kategori));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_kategori()
    {
        $kategori = Kategori::factory()->create();

        $response = $this->get(route('kategoris.show', $kategori));

        $response
            ->assertOk()
            ->assertViewIs('app.kategoris.show')
            ->assertViewHas('kategori');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_kategori()
    {
        $kategori = Kategori::factory()->create();

        $response = $this->get(route('kategoris.edit', $kategori));

        $response
            ->assertOk()
            ->assertViewIs('app.kategoris.edit')
            ->assertViewHas('kategori');
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

        $response = $this->put(route('kategoris.update', $kategori), $data);

        $data['id'] = $kategori->id;

        $this->assertDatabaseHas('kategoris', $data);

        $response->assertRedirect(route('kategoris.edit', $kategori));
    }

    /**
     * @test
     */
    public function it_deletes_the_kategori()
    {
        $kategori = Kategori::factory()->create();

        $response = $this->delete(route('kategoris.destroy', $kategori));

        $response->assertRedirect(route('kategoris.index'));

        $this->assertDeleted($kategori);
    }
}
