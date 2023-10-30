<?php

namespace App\Models;

class ProductOptions extends BaseModel
{
    const IMAGEPATH = 'productoptions' ; 

    protected $fillable = ['option_id','product_id'];

    public function option(){
    	return $this->belongsTo(Options::class,'option_id','id');
    } 

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    } 

    public function productOptionValues()
    {
        return $this->hasMany(ProductOptionsValues::class, 'product_option_id','id');
    }
}
