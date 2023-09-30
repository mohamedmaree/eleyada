<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Discussion extends BaseModel
{
    const IMAGEPATH = 'discussions' ; 

    use HasTranslations; 
    protected $fillable = ['topics', 'title', 'status', 'speaker_name', 'discussion_link','image'];
    public $translatable = ['topics', 'title'];

    public function saveImage(?array $attachment_ids): void
    {
        $this->image = $attachment_ids ?
            Attachment::find($attachment_ids[0])->relative_url
            : null;
        $this->save();
        $this->attachment()->sync(
            $attachment_ids
        );
    }

}
