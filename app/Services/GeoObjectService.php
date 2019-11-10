<?php

namespace App\Services;

use App\GeoObject;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Illuminate\Support\Facades\DB;

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
     * @param int $id
     *
     * @return GeoObject
     */
    public function get(int $id)
    {
        /** @var GeoObject $geoObject*/
        $geoObject = GeoObject::with('geoType')
            ->with('geoFeature')
            ->find($id);

        return $geoObject;
    }

    /**
     * Добавить геообъект
     *
     * @param array $geoObjectData
     *
     * @return GeoObject
     */
    public function add(array $geoObjectData)
    {
        DB::beginTransaction();

        /** @var GeoObject $geoObject*/
        $geoObject = GeoObject::create($geoObjectData);

        $geoFeature = $this->prepareFeatureData($geoObjectData);
        if (null !== $geoFeature) {
            $geoObject->geoFeatures()
                ->create($geoFeature);
        }
        DB::commit();

        return $this->get($geoObject->id);
    }

    /**
     * Обновть геообъект
     *
     * @param array $geoObjectData
     *
     * @return GeoObject
     */
    public function update(array $geoObjectData)
    {
        /** @var GeoObject $geoObject*/
        $geoObject = GeoObject::find($geoObjectData['id']);
        if ($geoObject) {
            DB::beginTransaction();
            $geoObject->fill($geoObjectData);
            $geoObject->save();

            $geoFeature = $this->prepareFeatureData($geoObjectData);
            if (null !== $geoFeature) {
                $geoObject->geoFeatures()
                    ->create($geoFeature);
            }
            DB::commit();

            $geoObject = $this->get($geoObject->id);
        }

        return $geoObject;
    }

    /**
     * Удалить геообъект
     *
     * @param array $geoObjectData
     *
     * @return GeoObject
     */
    public function delete(array $geoObjectData)
    {
        /** @var GeoObject $geoObject*/
        $geoObject = $this->get($geoObjectData['id']);
        if ($geoObject) {
            if (array_key_exists('arhive', $geoObjectData)) {
                // В архив
                $geoObject->is_arhive = true;
                $geoObject->save();
            } else {
                // Удалить
                DB::beginTransaction();
                $geoObject->geoFeatures()->delete();
                $geoObject->delete();
                DB::commit();
            }
        }

        return $geoObject;
    }

    /**
     * Получить список геометрий для геообъекта
     * @param int $idGeoObject
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function featuresList(int $idGeoObject)
    {
        /** @var GeoObject $geoObject*/
        $geoObject = GeoObject::find($idGeoObject);

        $features = $geoObject->geoFeatures()->orderBy('id', 'desc')->get();

        return $features;
    }

    /**
     * Подготовить геометрию для записи в БД
     *
     * @param array $geoObjectData
     *
     * @return array|null
     */
    protected function prepareFeatureData(array $geoObjectData) :?array
    {
        $geoFeature = null;

        if (array_key_exists('geo_feature', $geoObjectData)) {
            $geoFeature = $geoObjectData['geo_feature'];

            $geom = Geometry::fromJson(json_encode($geoFeature['geom']));
            $geomWkt = $geom->toWkt();
            $area = DB::raw("ST_Area(ST_GeomFromText('$geomWkt'))");

            $geoFeature['geom'] = $geom;
            $geoFeature['area'] = $area;
        }

        return $geoFeature;
    }
}
