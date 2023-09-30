<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class DiscussionResource extends JsonResource
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
            'id'           => $this->id,
            'title'        => $this->title,
            'topics'       => $this->topics,
            'status'       => $this->status,
            'speaker_name' => $this->speaker_name,
            'discussion_link'    => $this->discussion_link,
            'image'    => $this->image,
        ];
    }
}
