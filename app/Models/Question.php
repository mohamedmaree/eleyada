<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;


class Question extends BaseModel
{
    use HasTranslations;
    const IMAGEPATH = 'questions' ; 

    protected $fillable = ['parent_answer_id','category_id','question','type','image'];
    public $translatable = ['question'];

    public function category(){
    	return $this->belongsTo(Category::class);
    } 

    public function parentAnswer(){
    	return $this->belongsTo(Answer::class,'parent_answer_id','id');
    } 

    public function answers(){
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

}
