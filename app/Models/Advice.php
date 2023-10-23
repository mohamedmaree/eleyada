<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Advice extends BaseModel
{
    const IMAGEPATH = 'advice' ; 

    use HasTranslations; 
    protected $fillable = ['name','content' ,'image','video','product_link','type'];
    public $translatable = ['name','content'];


}
