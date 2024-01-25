<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait UploadImage
{
    public function uploadImage($file, $folderPath)
    {
        $path = 'uploads/'.$folderPath;

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

         # Upload Image
         $image['name'] = time().'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '-', $file->getClientOriginalName());
         $image['extension'] = $file->getClientOriginalExtension();
         $image['path'] = $path.'/'.$image['name'];
         $file->move($path, $image['name']);

         return $image;
    }

}
