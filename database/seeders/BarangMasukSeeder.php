<?php

namespace Database\Seeders;

use App\Models\BarangMasuk;
use Illuminate\Database\Seeder;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BarangMasuk::factory()
            ->count(5)
            ->create();
    }
}
