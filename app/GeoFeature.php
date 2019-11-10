<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoFeature extends Model
{
    public function geoObject()
    {
        return $this->belongsTo('App\geoObject');
    }
}
