<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FanQuery;
use App\Helpers\ImageVideo;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Fans;
use App\Models\Images;
use App\Models\Report;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function createProduct(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Fans::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $relativePath = ImageVideo::saveImage($image);
                Images::create([
                    'fans_id' => $product->id,
                    'image' => URL::to(Storage::url($relativePath))
                ]);
            }
        }
        if ($request->has('video')) {
            foreach ($request->file('video') as $video) {
                $relativePath = ImageVideo::saveVideo($video);
                Videos::create([
                    'fans_id' => $product->id,
                    'video' => URL::to(Storage::url($relativePath))
                ]);
            }
        }
        return response([
           $product,
            'message' => 'Product created successfully'
        ], 201);
    }

    public function importProductImage(Request $request)
    {
        $data = $request->all();
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $relativePath = ImageVideo::saveImage($image);
                Images::create([
                    'fans_id' => $data['fans_id'],
                    'image' => URL::to(Storage::url($relativePath))
                ]);
            }
        }
        if ($request->has('video')) {
            foreach ($request->file('video') as $video) {
                $relativePath = ImageVideo::saveVideo($video);
                Videos::create([
                    'fans_id' => $data['fans_id'],
                    'video' => URL::to(Storage::url($relativePath))
                ]);
            }
        }
        return response([
            'message' => 'Media inserted successfully'
        ], 201);
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $data = $request->validated();
        $fans = Fans::find($id);
        $img = Images::where('fans_id',$id)->get();
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                if (isset($img)) {
                    Storage::deleteDirectory('/public/images/fans' . dirname($img->image));
                }
                $relativePath = ImageVideo::saveImage($image);
                $imageUpdate = URL::to(Storage::url($relativePath));
                Images::where('fans_id', $id)->update($imageUpdate);
            }
        }
        $fans->update($data);
        return response([$data, 'message' => 'Product updated successfully'
        ], 201);
    }

    public function featureProduct($id)
    {
        $data = Fans::query()
            ->with(['images', 'videos', 'brands', 'technicals', 'fanType'])
            ->where('id', $id)
            ->get();
        return response(['feature' => $data]);
    }

    public function delete($id)
    {
        $fans = Fans::where('id', $id)->first();
        if (!empty($fans)) {
            $fans->delete();
        }
    }

    public function restore($id)
    {
        $fans = Fans::onlyTrashed()->where('id', $id)->first();
        if (!empty($fans)) {
            $fans->restore();
        }
    }

    public function forceDelete($id)
    {
        $fans = Fans::where('id', $id)->first();
        $images = Images::where('fans_id', $id)->first();
        $videos = Videos::where('fans_id', $id)->first();
        $reports = Report::where('fans_id', $id)->first();
        if (!empty($fans)) {
            if ($images){
            Storage::delete('/public/images/fans' . $images->image);
            $images->delete();
            }
            if ($videos){
            Storage::delete('/public/videos/fans' . $videos->video);
            $videos->delete();
            }
            $reports->delete();
            $fans->forceDelete();
        }
    }

    public function trash()
    {
        $trash = FanQuery::trashQuery();
        return response([$trash],201);
    }
}
//                $imageName = $data['name'] . '-image-' . time() . rand(1, 1000) . '.' . $image->extension();
//                $image->move(public_path('product_images'), $imageName);
