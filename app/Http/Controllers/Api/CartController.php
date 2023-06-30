<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Fans;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        list($products, $cartItems) = Cart::getProductAndCartItem();

        $total = 0;
        foreach ($products as $fan) {
            $total += $fan->price * $cartItems[$fan->id]['quantity'];
        }
        return response([
            'total_price' => $total,
            'cart_items' => $cartItems,
            'products' => $products,
            'count' => Cart::getCartItemsCount()
        ], 200);
    }

    public function addItem(Request $request)
    {

        $fanId = $request->get('fan_id');
        $quantity = $request->get('quantity');
        $user = $request->user();
        if ($user) {
            $cartItems = CartItem::where(['user_id' => $user->id, 'fan_id' => $fanId])->first();
            if ($cartItems) {
                $cartItems->quantity += $quantity;
                $cartItems->update();
            } else {
                $data = [
                    'user_id' => $user->id,
                    'fan_id' => $fanId,
                    'quantity' => $quantity
                ];
                CartItem::create($data);
            }
        }
        return response([
            'count' => Cart::getCartItemsCount()
        ]);
    }

    public function removeItem(Request $request,$id)
    {
        $user = $request->user();
        if ($user) {
            $cartItem = CartItem::where(['user_id' => $user->id, 'fan_id' => $id])->first();
            if ($cartItem) {
                $cartItem->delete();
            }
            return response([
                'count' => Cart::getCartItemsCount()
            ]);
        }
    }

    public function updateQuantity(Request $request)
    {
        $user = $request->user();
        $fanId = $request->get('fan_id');
        $Qty = $request->get('quantity');
        if ($user) {
            $cartItem = CartItem::where(['user_id' => $user->id, 'fan_id' => $fanId])->first();
            if ($cartItem) {
                $cartItem->update(['quantity' => $Qty]);
            }
            return response([
                $cartItem,
                'count' => Cart::getCartItemsCount()
            ]);
        }
    }
}
