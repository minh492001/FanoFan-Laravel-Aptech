<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Fans;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WishListController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $wishItems = WishList::where('user_id', $request->user()->id)->get();
        $ids = Arr::pluck($wishItems, 'fan_id');

        if ($user) {
            $wishlistItems = Fans::query()->with(['images', 'brands', 'technicals', 'fanType', 'wishlists'])
                ->whereHas('wishlists', function ($query) use ($ids) {
                    $query->whereIn('fan_id', $ids);
                })
                ->get();
            return response([
                'wishlistItems' => $wishlistItems,
            ], 200);
        }
    }

    public function addToWishList(Request $request)
    {
        $productId = $request->get('fan_id');
        $user = $request->user();
        if ($user) {
            $wishlistItems = WishList::where(['user_id' => $user->id, 'fan_id' => $productId])->first();
            if ($wishlistItems) {
                return response([
                    'message' => 'This item already existed in your wishlist'
                ], 403);
            } else {
                $cartItem = CartItem::where(['user_id' => $user->id, 'fan_id' => $productId])->first();
                if ($cartItem) {
                    $cartItem->delete();
                }
                $data = [
                    'user_id' => $user->id,
                    'fan_id' => $productId,
                ];
                WishList::create($data);
                return response([
                    'message' => 'Cart items deleted',
                    $cartItem
                ]);
            }
        }
        return response([
            'message' => 'Item has been added to your wishlist'
        ]);
    }

    public function storeWishList(Request $request)
    {
        $productId = $request->get('fan_id');
        $user = $request->user();
        if ($user) {
            $wishlistItems = WishList::where(['user_id' => $user->id, 'fan_id' => $productId])->first();
            if ($wishlistItems) {
                return response([
                    'message' => 'This item already existed in your wishlist'
                ], 403);
            } else {
                $data = [
                    'user_id' => $user->id,
                    'fan_id' => $productId,
                ];
                WishList::create($data);
            }
        }
        return response([
            'message' => 'Item has been added to your wishlist'
        ]);
    }

    public function removeItemFromWishList(Request $request, $id)
    {
        $user = $request->user();
        if ($user) {
            $wishlistItems = WishList::where(['user_id' => $user->id, 'fan_id' => $id])->first();
            if ($wishlistItems) {
                $wishlistItems->delete();
            }
            return response([
                $wishlistItems,
                'message' => 'Removed!'
            ]);
        }
    }

    public function moveToCart(Request $request)
    {
        $user = $request->user();
        $productId = $request->get('fan_id');
        if ($user) {
            $wishlistItems = WishList::where(['user_id' => $user->id, 'fan_id' => $productId])->first();
            if ($wishlistItems) {
                $cartItem = CartItem::where(['user_id' => $user->id, 'fan_id' => $productId])->first();
                if ($cartItem) {
                    $cartItem->quantity += 1;
                    $cartItem->update();
                    $wishlistItems->delete();
                }else{
                    $wishlistItems->delete();
                    $data = [
                        'user_id' => $user->id,
                        'fan_id' => $productId,
                        'quantity' => 1
                    ];
                    CartItem::create($data);
                }
            }
            return response([
                $wishlistItems
            ]);
        }
    }
}
