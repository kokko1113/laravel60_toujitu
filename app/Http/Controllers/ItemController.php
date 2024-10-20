<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Item::get();
        return view("dash",compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("item.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "price"=>"required|numeric",
        ],[
            "name.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました",
            "price.numeric"=>"エラーが発生しました",
        ]);
        Item::query()->create([
            "shop_id"=>Auth::id(),
            "name"=>$request->name,
            "price"=>$request->price,
        ]);
        return redirect(route("item_create"))->with(["message"=>"商品情報が登録されました"]);
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
        $item=Item::query()->find($id);
        return view("item.edit",compact("item"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=>"required",
            "price"=>"required",
        ],[
            "name.required"=>"エラーが発生しました",
            "price.required"=>"エラーが発生しました",
        ]);
        $item=Item::query()->find($id);
        $item->update([
            "name"=>$request->name,
            "price"=>$request->price,
        ]);
        return redirect(route("item_edit",$item->id))->with(["message"=>"商品情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Item::query()->find($id);
        $orders=Order::query()->where("item_id",$item->id)->get();
        foreach($orders as $order){//キーの渡し先も削除
            $order->delete();
        }
        $item->delete();
        return redirect(route("dash"));
    }
}
