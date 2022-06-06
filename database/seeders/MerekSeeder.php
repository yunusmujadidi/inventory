<?php

namespace Database\Seeders;

use App\Models\Merek;
use Illuminate\Database\Seeder;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merek::factory()
            ->count(5)
            ->create();
    }
}
