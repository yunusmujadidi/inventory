<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BarangMasuk;

use App\Models\Barang;
use App\Models\Supplier;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangMasukControllerTest extends TestCase
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
    public function it_displays_index_view_with_barang_masuks()
    {
        $barangMasuks = BarangMasuk::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('barang-masuks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.barang_masuks.index')
            ->assertViewHas('barangMasuks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_barang_masuk()
    {
        $response = $this->get(route('barang-masuks.create'));

        $response->assertOk()->assertViewIs('app.barang_masuks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_barang_masuk()
    {
        $data = BarangMasuk::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('barang-masuks.store'), $data);

        $this->assertDatabaseHas('barang_masuks', $data);

        $barangMasuk = BarangMasuk::latest('id')->first();

        $response->assertRedirect(route('barang-masuks.edit', $barangMasuk));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_barang_masuk()
    {
        $barangMasuk = BarangMasuk::factory()->create();

        $response = $this->get(route('barang-masuks.show', $barangMasuk));

        $response
            ->assertOk()
            ->assertViewIs('app.barang_masuks.show')
            ->assertViewHas('barangMasuk');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_barang_masuk()
    {
        $barangMasuk = BarangMasuk::factory()->create();

        $response = $this->get(route('barang-masuks.edit', $barangMasuk));

        $response
            ->assertOk()
            ->assertViewIs('app.barang_masuks.edit')
            ->assertViewHas('barangMasuk');
    }

    /**
     * @test
     */
    public function it_updates_the_barang_masuk()
    {
        $barangMasuk = BarangMasuk::factory()->create();

        $supplier = Supplier::factory()->create();
        $barang = Barang::factory()->create();

        $data = [
            'tanggal_masuk' => $this->faker->dateTime,
            'jumlah_masuk' => $this->faker->randomNumber,
            'supplier_id' => $supplier->id,
            'barang_id' => $barang->id,
        ];

        $response = $this->put(
            route('barang-masuks.update', $barangMasuk),
            $data
        );

        $data['id'] = $barangMasuk->id;

        $this->assertDatabaseHas('barang_masuks', $data);

        $response->assertRedirect(route('barang-masuks.edit', $barangMasuk));
    }

    /**
     * @test
     */
    public function it_deletes_the_barang_masuk()
    {
        $barangMasuk = BarangMasuk::factory()->create();

        $response = $this->delete(route('barang-masuks.destroy', $barangMasuk));

        $response->assertRedirect(route('barang-masuks.index'));

        $this->assertDeleted($barangMasuk);
    }
}
