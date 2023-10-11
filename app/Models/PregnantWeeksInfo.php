<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class PregnantWeeksInfo extends BaseModel
{
    const IMAGEPATH = 'pregnantweeksinfos' ; 

    use HasTranslations; 
    protected $fillable = ['order','name','mother_info','baby_info','baby_weight','baby_height' ,'image'];
    public $translatable = ['name','mother_info','baby_info'];

}
