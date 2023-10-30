<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class ProductOptionsValues extends BaseModel
{
    const IMAGEPATH = 'productoptionsvalues' ; 

    use HasTranslations; 
    protected $fillable = ['product_option_id','description'];
    public $translatable = ['description'];

    public function ProductOptions(){
    	return $this->belongsTo(ProductOptions::class,'product_option_id','id');
    } 

}
