<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(BarangSeeder::class);
        $this->call(BarangKeluarSeeder::class);
        $this->call(BarangMasukSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(LokasiSeeder::class);
        $this->call(MerekSeeder::class);
        $this->call(PosisiSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(UserSeeder::class);
    }
}
