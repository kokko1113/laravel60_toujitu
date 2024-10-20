<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getItem(Request $request)
    {
        $shop_id = $request->shop_id;
        $price = $request->price;
        $title = $request->title;
        $items = Item::get();
        $results = [];
        foreach ($items as $item) {
            $query = Item::query();
            if (isset($shop_id)) {
                $query->where("shop_id", $shop_id);
            }
            if (isset($price)) {
                $query->where("price", $price);
            }
            if (isset($title)) {
                $query->where("name", "LIKE", "%" . $title . "%");
            }
            $aaa = $query->find($item->id);
            if ($aaa != null) {
                $results[] = $aaa;
            }
        }
        if (empty($results)) {
            return response()->json(["error" => "エラーが発生しました"], 404);
        }
        return response()->json($results);
    }
    public function postOrder(Request $request)
    {
        if (isset($request->item_id) && isset($request->address)) {
            $item_id = $request->item_id;
            $address = $request->address;
            $item_price = Item::query()->where("id", $item_id)->first()->price;
            if ($request->coupon_code) {
                $coupon_code = $request->coupon_code;
                $coupon_discount = Coupon::query()->where("code", $coupon_code)->first();
                if ($coupon_discount) {
                    $price = $item_price - $coupon_discount->discount;
                    Order::query()->create([
                        "item_id" => $item_id,
                        "coupon_code" => $coupon_code,
                        "address" => $address,
                        "price" => $price,
                    ]);
                } else {
                    return response()->json(["error" => "エラーが発生しました"], 404);
                }
            } else {
                $price = $item_price;
                Order::query()->create([
                    "item_id" => $item_id,
                    "coupon_code" => null,
                    "address" => $address,
                    "price" => $price,
                ]);
            }
            return response()->json(["message" => "注文が登録されました"]);
        }
        return response()->json(["error" => "エラーが発生しました"], 404);
    }
}
