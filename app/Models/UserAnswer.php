<?php
namespace App\Models;

class UserAnswer extends BaseModel
{

    const IMAGEPATH = 'answers' ; 

    protected $fillable = ['user_id','question_id','answer'];
    //type = 'training','exam','home_work'
    public function question(){
    	return $this->belongsTo(Question::class);
    } 

    public function user(){
    	return $this->belongsTo(User::class);
    }   

    public static function userQuestionAnswer($user_id = null,$question_id = null){
    	return UserAnswer::where(['question_id' => $question_id,'user_id' => $user_id ])->first()->answer??'';
    }   

}
