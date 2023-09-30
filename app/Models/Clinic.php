<?php

namespace App\Models;

class Clinic extends BaseModel
{
    const IMAGEPATH = 'clinics' ; 

    protected $fillable=['name','location_link','booking_link','doctor_id','address'];

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
