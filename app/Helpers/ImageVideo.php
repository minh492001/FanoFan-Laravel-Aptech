<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageVideo {
    public static function saveImage(\Illuminate\Http\UploadedFile $image)
    {
        $path = 'images/fans/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }
        return $path . '/' . $image->getClientOriginalName();
    }

    public static function saveVideo(\Illuminate\Http\UploadedFile $video)
    {
        $path = 'videos/fans/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $video, $video->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$video->getClientOriginalName()}\"");
        }
        return $path . '/' . $video->getClientOriginalName();
    }
}


