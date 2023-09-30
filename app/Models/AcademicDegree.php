<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class AcademicDegree extends BaseModel
{
    const IMAGEPATH = 'academicdegrees' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
