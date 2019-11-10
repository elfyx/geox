<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class GeoFeature extends Model
{
    use SpatialTrait;

    protected $fillable = ['geo_object_id','area','geom'];

    protected $spatialFields = [
        'geom',
    ];

    /**
     * Связь с геобъектом
     */
    public function geoObject()
    {
        return $this->belongsTo('App\geoObject');
    }
}
