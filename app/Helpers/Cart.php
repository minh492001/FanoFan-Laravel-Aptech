<?php

namespace App\Helpers;


use App\Models\CartItem;
use App\Models\Fans;
use Illuminate\Support\Arr;

class Cart
{
    public static function getCartItemsCount(): int
    {
        $request = \request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->sum('quantity');
        }
    }

    public static function getCartItems()
    {
        $request = \request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->get()->map(
                fn($item) => ['fan_id' => $item->fan_id, 'quantity' => $item->quantity]
            );
        }
    }

    public static function getCountFromItems($cartItems)
    {
        return array_reduce(
            $cartItems,
            fn($carry, $item) => $carry + $item['quantity'],
            0
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getProductAndCartItem(): array|\Illuminate\Database\Eloquent\Collection
    {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'fan_id');
        $products = Fans::query()->with(['images', 'brands', 'technicals', 'fanType', 'carts'])
            ->whereHas('carts', function ($query) use ($ids) {
                $query->whereIn('fan_id', $ids);
            })
            ->get();
        $cartItems = Arr::keyBy($cartItems, 'fan_id');
        return [$products, $cartItems];
    }
}
