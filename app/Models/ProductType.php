<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class ProductType extends BaseModel
{
    const IMAGEPATH = 'producttypes' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];
    
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
