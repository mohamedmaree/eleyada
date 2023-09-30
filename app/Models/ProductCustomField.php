<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class ProductCustomField extends BaseModel
{
    const IMAGEPATH = 'productcustomfields' ; 

    use HasTranslations; 
    protected $fillable = ['key','is_title'];
    public $translatable = ['key'];
   
    protected $casts=[
        'is_title' => 'boolean'
    ];
}
