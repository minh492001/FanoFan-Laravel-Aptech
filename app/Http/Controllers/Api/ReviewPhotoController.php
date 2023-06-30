<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReviewPhoto;
use Illuminate\Http\Request;

class ReviewPhotoController extends Controller
{
    public function getAllPhotos(Request $request,$productId)
    {
            $allPhotos = ReviewPhoto::query()->where('fans_id', $productId)->get();
            return response(['allPhotos' => $allPhotos], 201);
    }
}
