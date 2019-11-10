<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoObject extends Model
{
    protected $fillable = ['geo_type_id','name','description'];

    /**
     * Связь с геотипами
     */
    public function geoType()
    {
        return $this->belongsTo('App\GeoType');
    }

    /**
     * Связь с геометриями
     */
    public function geoFeatures()
    {
        return $this->hasMany('App\GeoFeature');
    }

    /**
     * Связь с последней геометрией
     */
    public function geoFeature()
    {
        return $this->hasOne('App\GeoFeature')->orderBy('id', 'desc');
    }
}
