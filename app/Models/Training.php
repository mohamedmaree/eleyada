<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Training extends BaseModel
{
    const IMAGEPATH = 'trainings' ; 

    use HasTranslations; 
    protected $fillable = ['topics', 'description','title','is_paid', 'link_to_order', 'product_id', 'image', 'video'];
    public $translatable = ['description','topics',"title"];

    protected $casts=[
        'is_paid' => 'bool'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
