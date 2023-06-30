<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ReviewPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $productId = $request->get('fans_id');
            $comments = Comment::query()->with(['review_photos', 'users'])
                ->where(['fans_id'=> $productId])->get();
            return response(['allComments'=>$comments], 201);
    }

    public function storeComment(Request $request)
    {
        $content = $request->validate([
            'content' => ['required', 'string'],
            'image' => 'nullable'
        ]);
        $productId = $request->get('fans_id');
        $user = $request->user();
        $photos = $content['image'] ?? null;
        if ($user) {
            $comment = Comment::create([
                'content' => $content['content'],
                'fans_id' => $productId,
                'user_id' => $user->id,
            ]);
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $relativePath = $this->saveImage($image);
                    ReviewPhoto::create([
                        'photo' => URL::to(Storage::url($relativePath)),
                        'comment_id' => $comment->id,
                        'fans_id' => $productId,
                    ]);
                }
            }
            return response([$comment], 200);
        }
    }

    public function deleteComment()
    {

    }

    public function updateComment()
    {

    }

    private function saveImage(\Illuminate\Http\UploadedFile $image)
    {
        $path = 'review/photos' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }
        return $path . '/' . $image->getClientOriginalName();
    }
}
