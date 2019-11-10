<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\GeoFeature;

class GeoFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 20; $i++) {
            $lat = rand(-90, 90);
            $lon =  rand(-180, 180);

            GeoFeature::create([
                'id' => $i,
                'geo_object_id' => rand(1, 4),
                'area' => 0,
                'geom' => DB::raw("POINT($lon, $lat)"),
            ]);
        }
    }
}
