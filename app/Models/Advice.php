<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Advice extends BaseModel
{
    const IMAGEPATH = 'advice' ; 

    use HasTranslations; 
    protected $fillable = ['name','content' ,'image','video','product_id','type'];
    public $translatable = ['name','content'];

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    } 

}
