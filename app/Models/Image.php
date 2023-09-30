<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;


class Image extends BaseModel
{
    const IMAGEPATH = 'images' ; 
    use HasTranslations; 
    protected $fillable = ['image','name'];
    public $translatable = ['name'];
}
