<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoType extends Model
{
    public function geoObjects()
    {
        return $this->hasMany('App\GeoObject');
    }
}
