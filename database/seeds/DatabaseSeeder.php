<?php

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
        $this->call(GeoTypeTableSeeder::class);
        $this->call(GeoObjectTableSeeder::class);
        $this->call(GeoFeatureTableSeeder::class);
    }
}
