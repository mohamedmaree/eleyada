<?php

namespace App\Models;


class Order extends BaseModel
{
    const IMAGEPATH = 'orders' ; 


    protected $fillable=['doctor_id','region_id','name','phone_number','address','total_amount','delivery','status','delivery_confirmation'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
          $lastId = self::max('id') ?? 0;
          $model->order_num = date('Y') . ($lastId + 1);
        });
      }

}
