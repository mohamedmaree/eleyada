<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Speciality extends BaseModel
{
    const IMAGEPATH = 'specialities' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
