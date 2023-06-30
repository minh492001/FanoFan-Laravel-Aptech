<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function getList($fanTypeId)
    {
//        $fanTypeId = $request->get('fan_types_id');
        $article = Article::query()->where('fan_types_id', $fanTypeId)->get();
        return response([
            'article' => $article], 200);
    }

    public function storeArticle(ArticleRequest $request)
    {
        $article = $request->validated();
        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $article['image'] ?? null;
        if ($image) {
            $relativePath = $this->saveImage($image);
            $article['image'] = URL::to(Storage::url($relativePath));
        }
        $newPost = Article::create($article);
        return response([$newPost], 200);
    }

    public function articleCeilingFan()
    {
        return $this->getList(1);
    }
    public function articleFloorFan()
    {
        return $this->getList(2);
    }
    public function articleTableFan()
    {
        return $this->getList(9);
    }
    private function saveImage(\Illuminate\Http\UploadedFile $image)
    {
        $path = 'images/articles/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }
        return $path . '/' . $image->getClientOriginalName();
    }
}
