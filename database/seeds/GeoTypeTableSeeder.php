<?php

use Illuminate\Database\Seeder;
use App\GeoType;

class GeoTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++) {
            GeoType::create([
                'id' => $i,
                'name' => 'Type'.$i,
            ]);
        }
    }
}
