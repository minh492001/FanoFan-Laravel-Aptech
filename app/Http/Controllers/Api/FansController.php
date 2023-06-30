<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FanQuery;
use App\Http\Controllers\Controller;
use App\Models\Fans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FansController extends Controller
{
    public function getList($responseName, $id, $brand, $orderPrice)
    {
        if ($orderPrice) {
            $data = FanQuery::typeBrandQueryWithFilter($id, $brand, $orderPrice);
            return response([
                $responseName => $data
            ], 201);
        } else {
            $data = FanQuery::typeBrandQueryWithoutFilter($id, $brand);
            return response([
                $responseName => $data
            ], 201);
        }
    }

    public function getAllFans()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $data = FanQuery::searchingQuery($perPage, $search);
        return response([$data], 201);
    }

    public function getResultBySearch()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $data = FanQuery::searchingQuery($perPage, $search);
        return response([$data], 201);
    }

    public function getDetailById(Request $request, $id)
    {
        $brand = $request->input('id', $id);
        $data = Fans::with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->where('id', '=', $id)
            ->get();
        return response([$data], 201);
    }

    public function getFansByBrand(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        $data = FanQuery::withOrderBy($brand, $orderBy);
        return response([$data], 201);
    }

    public function getResultSearchBySpecificType()
    {
        $search = request('search', '');
        $typeId = request('type_id', '');
        $data = FanQuery::searchBySpecificType($typeId, $search);
        return response(['searchingData' => $data], 201);
    }

    public function getSameFansByType()
    {
        $type = request('type', '');
        $data = FanQuery::sameTypeQuery($type);
        return response(['sameData' => $data], 201);
    }

    public function allFans(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        $data = FanQuery::allFanByBrandAndOrder($brand, $orderBy);
        return response(['all_fan' => $data], 201);
    }

    public function getCeilingFan()
    {
        $brand = request('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('ceilingFan', 1, $brand, $orderBy);
    }

    public function getFloorFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('floorFan', 2, $brand, $orderBy);
    }

    public function getTowerFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('towerFan', 3, $brand, $orderBy);
    }

    public function getWallFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('wallFan', 4, $brand, $orderBy);
    }

    public function getIslandFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('islandFan', 5, $brand, $orderBy);
    }

    public function getBoxFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('boxFan', 6, $brand, $orderBy);
    }

    public function getSteamFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('steamFan', 7, $brand, $orderBy);
    }

    public function getIndustryFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('industryFan', 8, $brand, $orderBy);
    }

    public function getTableFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('tableFan', 9, $brand, $orderBy);
    }

    public function getBatteryChargeFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('batteryFan', 10, $brand, $orderBy);
    }

    public function getSolarFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('solarFan', 11, $brand, $orderBy);
    }

    public function getConditionerFan(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('conditionerFan', 12, $brand, $orderBy);
    }

    public function getAirCooler(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('airCooler', 13, $brand, $orderBy);
    }

    public function getAirConditioner(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('airConditioner', 14, $brand, $orderBy);
    }

    public function getAirCurtain(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('airCurtain', 15, $brand, $orderBy);
    }

    public function getVentilator(Request $request)
    {
        $brand = $request->input('brand', '');
        $orderBy = request('order_by_type', '');
        return $this->getList('ventilator', 16, $brand, $orderBy);
    }
}

