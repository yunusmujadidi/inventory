<?php

namespace Database\Factories;

use App\Models\Merek;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerekFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Merek::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'merek' => $this->faker->text(255),
        ];
    }
}
