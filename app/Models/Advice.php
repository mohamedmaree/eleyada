<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Advice extends BaseModel
{
    const IMAGEPATH = 'advice' ; 

    use HasTranslations; 
    protected $fillable = ['name','content' ,'image'];
    public $translatable = ['name','content'];

}
