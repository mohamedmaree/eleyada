<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use App\Models\UserAnswer;
use App\Http\Requests\Api\AnswerQuestionRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Questions\QuestionsResource;
use App\Http\Requests\Api\StoreGoalRequest;


use App\Traits\ResponseTrait;

class QuestionsController extends Controller
{
    use ResponseTrait;

    public function publicQuestions(){
        $questions = QuestionsResource::collection(Question::with('answers')->where(['category_id' => 0,'parent_answer_id' => 0])->get());
        return $this->successData($questions);
    }

    public function categoryQuestions(Category $category){
        $questions = QuestionsResource::collection(Question::with('answers')->where(['category_id' => $category->id,'parent_answer_id'=>0])->get());
        return $this->successData($questions);
    }

    public function answerQuestion(Request $request){  
        foreach($request->all() as $req){
            UserAnswer::updateOrCreate( ['user_id'     => auth()->id() , 'question_id' => $req['question_id']??null],
            [ 'answer'      => $req['answer']??null]); 
        }
        // لو من ضمن الاجابات اجابة سؤال ف اي اسبوع من الحمل واي يوم من الحمل ..اعمل الحسبة بتاع تاريخ بداية الحمل
        if($week = auth()->user()->questionsAnswers()->where(['question_id' => 7])->first()){
          $day = auth()->user()->questionsAnswers()->where(['question_id' => 8])->first();
          $num_days = (((int)$week->answer - 1) * 7 )+ (int)$day->answer;
          $start_pregnant_date = date('Y-m-d',strtotime('-'.$num_days.' days'));
          auth()->user()->update(['start_pregnant_date' => $start_pregnant_date]);
        }
      return $this->successMsg(__('apis.saved_success'));
    }

    public function storeGoal(StoreGoalRequest $request){  
        $user = auth()->user();
        $user->update(['category_id' => $request->category_id]);
      return $this->successMsg(__('apis.saved_success'));
    }


  
}
