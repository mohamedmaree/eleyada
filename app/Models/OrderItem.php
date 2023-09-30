<?php

namespace App\Models;


class OrderItem extends BaseModel
{
    const IMAGEPATH = 'orderitems' ; 

    protected $fillable = ['quantity', 'product_id', 'order_id', 'price', 'subtotal'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
