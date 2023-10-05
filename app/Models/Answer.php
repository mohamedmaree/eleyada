<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;


class Answer extends BaseModel
{
    use HasTranslations;
    const IMAGEPATH = 'answers' ; 

    protected $fillable = ['question_id','answer'];
    public $translatable = ['answer'];


    public function question(){
    	return $this->belongsTo(Question::class);
    } 

    public function subQuestions(){
        return $this->hasMany(Question::class, 'parent_answer_id', 'id');
    }
}
