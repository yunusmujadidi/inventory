<?php

namespace Database\Factories;

use App\Models\BarangMasuk;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangMasukFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BarangMasuk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tanggal_masuk' => $this->faker->dateTime,
            'jumlah_masuk' => $this->faker->randomNumber,
            'supplier_id' => \App\Models\Supplier::factory(),
            'barang_id' => \App\Models\Barang::factory(),
        ];
    }
}
