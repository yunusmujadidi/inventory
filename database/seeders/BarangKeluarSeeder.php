<?php

namespace Database\Seeders;

use App\Models\BarangKeluar;
use Illuminate\Database\Seeder;

class BarangKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BarangKeluar::factory()
            ->count(5)
            ->create();
    }
}
