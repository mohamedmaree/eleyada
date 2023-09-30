<?php

namespace App\Models;


class ClinicNumber extends BaseModel
{
    const IMAGEPATH = 'clinicnumbers' ; 

    protected $fillable=['clinic_id','number'];

    protected function number(): Attribute
    {
            return Attribute::make(
                get: fn($value, array $attributes) => "0".$attributes['number'] ,
            );
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }
}
