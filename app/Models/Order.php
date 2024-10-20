<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        "item_id",
        "coupon_code",
        "address",
        "price",
    ];

    public function item(){
        $this->belongsTo(Item::class,"items");
    }
    public function coupon(){
        $this->belongsTo(Coupon::class,"coupons");
    }
}
