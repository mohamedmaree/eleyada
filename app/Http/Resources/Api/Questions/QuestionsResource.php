<?php

namespace App\Http\Resources\Api\Questions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Questions\AnswersResource;

class QuestionsResource extends JsonResource
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
            'id'               => $this->id,
            'parent_answer_id' => $this->parent_answer_id,
            'category_id'      => $this->category_id,
            'question'         => $this->question,
            'type'             => $this->type,
            'image'            => $this->image,
            'answers'          => AnswersResource::collection($this->answers),
        ];
    }
}
