<?php

namespace App\Http\Resources\Api\Questions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Questions\QuestionsResource;

class AnswersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'question_id' => $this->question_id,
            'answer'      => $this->answer,
            'have_sub_questions' => count($this->subQuestions) ? true : false,
            'sub_questions' => QuestionsResource::collection($this->subQuestions)
        ];
    }
}
