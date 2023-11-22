<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Symptoms extends BaseModel
{
    const IMAGEPATH = 'symptoms' ; 

    use HasTranslations; 
    protected $fillable = ['name','parent_id'];
    public $translatable = ['name'];
    
    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
   }
   
    public function childes(){
        return $this->hasMany(self::class,'parent_id');
    }

}
