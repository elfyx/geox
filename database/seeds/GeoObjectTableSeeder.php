<?php

use Illuminate\Database\Seeder;
use App\GeoObject;

class GeoObjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 5; $i++) {
            GeoObject::create([
                'id' => $i,
                'geo_type_id' => rand(1, 10),
                'name' => 'Object_'.$i,
                'description' => 'Description_'.$i,
            ]);
        }
    }
}
