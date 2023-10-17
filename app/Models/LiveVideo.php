<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class LiveVideo extends BaseModel
{
    const IMAGEPATH = 'livevideos' ; 

    use HasTranslations; 
    protected $fillable = ['topics', 'title', 'status', 'speaker_name', 'link','image'];
    public $translatable = ['topics', 'title'];


}
