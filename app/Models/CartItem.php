<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CartItem extends BaseModel
{
    const IMAGEPATH = 'cartitems' ; 

    use HasTranslations; 
    public $translatable = ['title','description'];
    protected $fillable=['product_id','doctor_id','quantity'];

    public function user()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
