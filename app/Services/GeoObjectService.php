<?php

namespace App\Services;

use App\GeoObject;

class GeoObjectService
{
    /**
     * Получить список геообъектов
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function scroll()
    {
        $geoObjects = GeoObject::with('geoType')
            ->with('geoFeature')
            ->get();

        return $geoObjects;
    }

    /**
     * Получить определенный геобъект
     *
     * @param $id
     *
     * @return GeoObject
     */
    public function get($id)
    {
        /** @var GeoObject $geoObject*/
        $geoObject = GeoObject::with('geoType')
            ->with('geoFeature')
            ->find($id);

        return $geoObject;
    }
}
