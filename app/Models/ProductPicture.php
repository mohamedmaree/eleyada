<?php

namespace App\Models;

class ProductPicture extends BaseModel
{
    const IMAGEPATH = 'productpictures' ; 

    protected $fillable =['product_id','image','description'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
