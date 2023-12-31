<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Product extends BaseModel
{
    const IMAGEPATH = 'products' ; 

    use HasTranslations; 
    public $translatable = ['details','benefits','name'];
    protected $fillable = ['name','details','benefits','price', 'insertion_technique', 'icon','video', 'product_type_id'];//,'product_custom_field_id','value','order'];

    protected $casts = [
        'price'         => 'decimal:2',
      ];
    
      public function getIconAttribute() {
        if (isset($this->attributes['icon'])) {
            $image = $this->getImage($this->attributes['icon'], static::IMAGEPATH);
        } else {
            $image = $this->defaultImage( static::IMAGEPATH);
        }
        return $image;
    }

    public function setIconAttribute($value) {
        if (null != $value && is_file($value) ) {
            isset($this->attributes['icon']) ? $this->deleteFile($this->attributes['icon'] , static::IMAGEPATH) : '';
            $this->attributes['icon'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }
    }

    public function pictures()
    {
        return $this->hasMany(ProductPicture::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function saveImage(?array $attachment_ids): void
    {
        if ($attachment_ids) {
            $this->pictures()->delete();
            foreach ($attachment_ids as $id) {
                $this->pictures()->create([
                    'image' => Attachment::find($id)->relative_url
                ]);
            }
        }

        $this->save();
        $this->attachment()->sync(
            $attachment_ids
        );
    }
    
    // public function productCustomField()
    // {
    //     return $this->belongsTo(ProductCustomField::class);
    // }

    public function productOptions()
    {
        return $this->hasMany(ProductOptions::class, 'product_id','id');
    }
}
