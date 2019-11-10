<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoObject extends Model
{
    public function geoType()
    {
        return $this->belongsTo('App\GeoType');
    }

    public function geoFeatures()
    {
        return $this->hasMany('App\GeoFeature');
    }
}
