<?php

namespace App\Models;


class UserSymptoms extends BaseModel
{
    const IMAGEPATH = 'usersymptoms' ; 

    protected $fillable = ['user_id','symptoms_id' ,'date'];

    public function symptoms(){
    	return $this->belongsTo(Symptoms::class,'symptoms_id','id');
    } 

    public function user(){
    	return $this->belongsTo(User::class);
    }   


}
