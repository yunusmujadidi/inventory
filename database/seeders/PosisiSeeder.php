<?php

namespace Database\Seeders;

use App\Models\Posisi;
use Illuminate\Database\Seeder;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posisi::factory()
            ->count(5)
            ->create();
    }
}
