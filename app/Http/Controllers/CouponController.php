<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons=Coupon::get();
        return view("coupon.index",compact("coupons"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("coupon.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "code"=>"required",
            "discount"=>"required",
        ],[
            "code.required"=>"エラーが発生しました",
            "discount.required"=>"エラーが発生しました",
        ]);
        Coupon::query()->create([
            "shop_id"=>Auth::id(),
            "code"=>$request->code,
            "discount"=>$request->discount,
        ]);
        return redirect(route("coupon_create"))->with(["message"=>"クーポン情報が登録されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon=Coupon::query()->find($id);
        return view("coupon.edit",compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "code"=>"required",
            "discount"=>"required",
        ],[
            "code.required"=>"エラーが発生しました",
            "discount.required"=>"エラーが発生しました",
        ]);
        $coupon=Coupon::query()->find($id);
        $coupon->update([
            "code"=>$request->code,
            "discount"=>$request->discount,
        ]);
        return redirect(route("coupon_edit",$coupon->id))->with(["message"=>"クーポン情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon=Coupon::query()->find($id);
        $orders=Order::query()->where("coupon_code",$coupon->code)->get();
        foreach($orders as $order){//キーの渡し先も削除
            $order->delete();
        }
        $coupon->delete();
        return redirect(route("coupon_index"));
    }
}
