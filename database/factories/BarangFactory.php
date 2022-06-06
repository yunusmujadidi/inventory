<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_barang' => $this->faker->word(255),
            'nama_barang' => $this->faker->word(255),
            'stok' => $this->faker->randomNumber,
            'harga' => $this->faker->randomNumber(2),
            'merek_id' => \App\Models\Merek::factory(),
            'kategori_id' => \App\Models\Kategori::factory(),
            'lokasi_id' => \App\Models\Lokasi::factory(),
        ];
    }
}
