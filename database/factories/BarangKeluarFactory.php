<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\BarangKeluar;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangKeluarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BarangKeluar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tanggal_keluar' => $this->faker->dateTime,
            'jumlah_keluar' => $this->faker->randomNumber,
            'lokasi_id' => \App\Models\Lokasi::factory(),
            'barang_id' => \App\Models\Barang::factory(),
        ];
    }
}
