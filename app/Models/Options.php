<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Options extends BaseModel
{
    const IMAGEPATH = 'productoptions' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
