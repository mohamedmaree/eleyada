<?php

namespace App\Models;

class Certificate extends BaseModel
{
    const IMAGEPATH = 'certificates' ; 

    protected $fillable = ['image', 'doctor_id'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
