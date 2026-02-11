<?php

namespace App\Traits;

use App\Models\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait FileUpload
{

    public function uploadFile(UploadedFile $file, $directory = '', string $name= '', Model $model): void
    {
        $filename = $name . uniqid() . '.' . $file->getClientOriginalExtension();

        //move file to storage
        $filePath = $file->storeAs($directory, $filename, 'dir_public');

        if($filePath){
            $fileStore = new Document();
            $fileStore->path = 'uploads/'.$filePath;
            $fileStore->file_size = $file->getSize();
            $fileStore->file_type = $file->getMimeType();
            $model->documents()->save($fileStore);
        }
    }

    public function removeFile($file):void {

        $file_path = public_path($file);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
    }

}
