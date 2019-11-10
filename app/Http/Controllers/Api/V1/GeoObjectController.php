<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\GeoObjectService;
use Illuminate\Http\Request;

class GeoObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GeoObjectService $geoObjectService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GeoObjectService $geoObjectService)
    {
        $result = $geoObjectService->scroll();

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param GeoObjectService $geoObjectService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, GeoObjectService $geoObjectService)
    {
        $geoObjectData = $request->all();
        $result = $geoObjectService->add($geoObjectData);

        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param GeoObjectService $geoObjectService
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GeoObjectService $geoObjectService, $id)
    {
        $result = $geoObjectService->get($id);

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param GeoObjectService $geoObjectService
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, GeoObjectService $geoObjectService, $id)
    {
        $geoObjectData = $request->all();
        $geoObjectData['id'] = $id;

        $result = $geoObjectService->update($geoObjectData);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GeoObjectService $geoObjectService
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(GeoObjectService $geoObjectService, $id)
    {
        $geoObjectData['id'] = $id;
        $result = $geoObjectService->delete($geoObjectData);

        return response()->json($result, 204);
    }

    /**
     * Get features list for geoobject.
     *
     * @param GeoObjectService $geoObjectService
     * @param int $idGeoObject
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function featuresList(GeoObjectService $geoObjectService, $idGeoObject)
    {
        $result = $geoObjectService->featuresList($idGeoObject);

        return response()->json($result);
    }
}
