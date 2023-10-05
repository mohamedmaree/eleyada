<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use App\Models\UserAnswer;
use App\Http\Requests\Api\AnswerQuestionRequest;

use App\Http\Resources\Api\Questions\QuestionsResource;


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

    public function answerQuestion(AnswerQuestionRequest $request){        
        $question = Question::find($request->question_id);
        UserAnswer::updateOrCreate( ['user_id'     => auth()->id() , 'question_id' => $question->id],
                                    [ 'answer'      => $request->answer]);      
      return $this->successMsg(__('apis.saved_success'));
    }
  
}
