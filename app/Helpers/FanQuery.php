<?php

namespace App\Helpers;

use App\Models\Fans;

class FanQuery
{
    public static function searchingQuery($perPage, $search)
    {
        return Fans::query()->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->where('name', 'like', "%{$search}%")
            ->orWhere('product_code', 'like', "%{$search}%")
            ->orWhereHas('brands', function ($query) use ($search) {
                $query->where('Brand_name', 'like', "%{$search}%");
            })
            ->orWhereHas('fanType', function ($query) use ($search) {
                $query->where('type', 'like', "%{$search}%");
            })->paginate($perPage);
    }

    public static function typeBrandQueryWithFilter($id, $brand, $orderPrice)
    {
        return Fans::query()
            ->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->where('type_id', '=', $id)
            ->whereHas(
                'brands', function ($query) use ($brand) {
                $query->where('Brand_name', 'like', '%' . $brand . '%');
            })
            ->orderBy('price', $orderPrice)
            ->get();
    }

    public static function typeBrandQueryWithoutFilter($id, $brand,)
    {
        return Fans::query()
            ->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->where('type_id', '=', $id)
            ->whereHas(
                'brands', function ($query) use ($brand) {
                $query->where('Brand_name', 'like', '%' . $brand . '%');
            })->get();
    }

    public static function withOrderBy($brand, $orderBy)
    {
        if ($orderBy) {
            return Fans::query()->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
                ->whereHas(
                    'brands', function ($query) use ($brand) {
                    $query->where('Brand_name', 'like', '%' . $brand . '%');
                })
                ->orderBy('price', $orderBy)
                ->paginate(10);
        } else {
            return Fans::query()->with(['images', 'brands', 'technicals', 'fanType'])
                ->whereHas(
                    'brands', function ($query) use ($brand) {
                    $query->where('Brand_name', 'like', '%' . $brand . '%');
                })
                ->paginate(10);
        }
    }
    public static function allFanByBrandAndOrder($brand, $orderBy)
    {
        if ($orderBy) {
            return Fans::query()->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
                ->whereHas(
                    'brands', function ($query) use ($brand) {
                    $query->where('Brand_name', 'like', '%' . $brand . '%');
                })
                ->orderBy('price', $orderBy)
                ->get();
        } else {
            return Fans::query()->with(['images', 'brands', 'technicals', 'fanType'])
                ->whereHas(
                    'brands', function ($query) use ($brand) {
                    $query->where('Brand_name', 'like', '%' . $brand . '%');
                })
                ->get();
        }
    }

    public static function searchBySpecificType($typeId, $search)
    {
        if (!empty($typeId)) {
            return Fans::query()->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
                ->where('type_id', $typeId)
                ->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('brands', function ($query) use ($search) {
                    $query->where('Brand_name', 'like', '%' . $search . '%');
                })
                ->get();
        } else {
            return Fans::query()->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
                ->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('brands', function ($query) use ($search) {
                    $query->where('Brand_name', 'like', '%' . $search . '%');
                })
                ->get();
        }

    }

    public static function sameTypeQuery($type)
    {
        return Fans::query()->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->whereHas(
                'fanType', function ($query) use ($type) {
                $query->where('type', 'like', '%' . $type . '%');
            })->get();
    }

    public static function trashQuery()
    {
        return Fans::onlyTrashed()
            ->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->paginate(10);
    }
}
