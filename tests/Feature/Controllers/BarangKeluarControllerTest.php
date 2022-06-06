<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BarangKeluar;

use App\Models\Lokasi;
use App\Models\Barang;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangKeluarControllerTest extends TestCase
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
    public function it_displays_index_view_with_barang_keluars()
    {
        $barangKeluars = BarangKeluar::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('barang-keluars.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.barang_keluars.index')
            ->assertViewHas('barangKeluars');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_barang_keluar()
    {
        $response = $this->get(route('barang-keluars.create'));

        $response->assertOk()->assertViewIs('app.barang_keluars.create');
    }

    /**
     * @test
     */
    public function it_stores_the_barang_keluar()
    {
        $data = BarangKeluar::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('barang-keluars.store'), $data);

        $this->assertDatabaseHas('barang_keluars', $data);

        $barangKeluar = BarangKeluar::latest('id')->first();

        $response->assertRedirect(route('barang-keluars.edit', $barangKeluar));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_barang_keluar()
    {
        $barangKeluar = BarangKeluar::factory()->create();

        $response = $this->get(route('barang-keluars.show', $barangKeluar));

        $response
            ->assertOk()
            ->assertViewIs('app.barang_keluars.show')
            ->assertViewHas('barangKeluar');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_barang_keluar()
    {
        $barangKeluar = BarangKeluar::factory()->create();

        $response = $this->get(route('barang-keluars.edit', $barangKeluar));

        $response
            ->assertOk()
            ->assertViewIs('app.barang_keluars.edit')
            ->assertViewHas('barangKeluar');
    }

    /**
     * @test
     */
    public function it_updates_the_barang_keluar()
    {
        $barangKeluar = BarangKeluar::factory()->create();

        $lokasi = Lokasi::factory()->create();
        $barang = Barang::factory()->create();

        $data = [
            'tanggal_keluar' => $this->faker->dateTime,
            'jumlah_keluar' => $this->faker->randomNumber,
            'lokasi_id' => $lokasi->id,
            'barang_id' => $barang->id,
        ];

        $response = $this->put(
            route('barang-keluars.update', $barangKeluar),
            $data
        );

        $data['id'] = $barangKeluar->id;

        $this->assertDatabaseHas('barang_keluars', $data);

        $response->assertRedirect(route('barang-keluars.edit', $barangKeluar));
    }

    /**
     * @test
     */
    public function it_deletes_the_barang_keluar()
    {
        $barangKeluar = BarangKeluar::factory()->create();

        $response = $this->delete(
            route('barang-keluars.destroy', $barangKeluar)
        );

        $response->assertRedirect(route('barang-keluars.index'));

        $this->assertDeleted($barangKeluar);
    }
}
