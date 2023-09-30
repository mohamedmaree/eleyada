<?php

namespace App\Models;

class ClinicPictures extends BaseModel
{
    const IMAGEPATH = 'clinicpictures' ; 

    protected $fillable = ['image', 'clinic_id'];

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }
}
