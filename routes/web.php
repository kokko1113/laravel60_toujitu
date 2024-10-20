<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("admin")->group(function(){
    Route::get("/login",[LoginController::class,"login"])->name("login");
    Route::post("/check",[LoginController::class,"check"])->name("check");
});

Route::prefix("admin")->middleware("auth")->group(function(){
    Route::get("/logout",[LoginController::class,"logout"])->name("logout");
    
    Route::get("/dash",[ItemController::class,"index"])->name("dash");
    Route::get("/item",[ItemController::class,"create"])->name("item_create");
    Route::post("/item",[ItemController::class,"store"])->name("item_store");
    Route::get("/item/{id}",[ItemController::class,"edit"])->name("item_edit");
    Route::patch("/item/{id}",[ItemController::class,"update"])->name("item_update");
    Route::delete("/item/{id}",[ItemController::class,"destroy"])->name("item_destroy");
    
    Route::get("/coupon",[CouponController::class,"index"])->name("coupon_index");
    Route::get("/coupon/create",[CouponController::class,"create"])->name("coupon_create");
    Route::post("/coupon",[CouponController::class,"store"])->name("coupon_store");
    Route::get("/coupon/{id}",[CouponController::class,"edit"])->name("coupon_edit");
    Route::patch("/coupon/{id}",[CouponController::class,"update"])->name("coupon_update");
    Route::delete("/coupon/{id}",[CouponController::class,"destroy"])->name("coupon_destroy");
});