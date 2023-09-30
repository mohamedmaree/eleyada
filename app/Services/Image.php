<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Str;
class Image
{
    protected string $pathInPublic;
    protected UploadedFile $file;

    public function __construct(UploadedFile $file, string $pathInPublic)
    {
        $this->file = $file;
        $this->pathInPublic = $pathInPublic;
    }

    public static function delete(string $image): bool
    {
        // $path = str($image)->replace('storage', 'public');
        $path = Str::replace('storage', 'public',$image);
        return \Storage::delete($path);
    }

    private function saveAsAttachment(){
        $fileName = $this->file->getFilename();
        $extension = $this->file->getExtension();
        $mimeType=$this->file->getMimeType();
//        $randomName=Generate
    }



    public function save()
    {
        $filenameWithExt = $this->file->getClientOriginalName();
        // Get Filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just Extension
        $extension = $this->file->getClientOriginalExtension();
        // Filename To store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $this->file->storeAs('public/' . $this->pathInPublic . '/images', $fileNameToStore);

        return Str::replace('storage', 'public',$path);
        // return str($path)->replace('public', 'storage');
    }
}
