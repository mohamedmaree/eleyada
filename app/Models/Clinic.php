<?php

namespace App\Models;

class Clinic extends BaseModel
{
    const IMAGEPATH = 'clinics' ; 

    protected $fillable=['name','location_link','booking_link','doctor_id','address','lat','lng'];
    protected $casts = [
        'lat'   => 'decimal:10',
        'lng'   => 'decimal:10',
    ];

    public function Numbers()
    {
        return $this->hasMany(ClinicNumber::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function Pictures()
    {
        return $this->hasMany(ClinicPictures::class);
    }
}
