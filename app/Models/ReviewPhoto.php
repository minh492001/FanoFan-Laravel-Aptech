<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
class ReviewPhoto extends Model
{
    use HasFactory;
    protected $table = 'review_photos';
    protected $guarded = [];

    protected $fillable = [
        'photo',
        'comment_id',
        'fans_id'
    ];
    public function comments()
    {
        return $this->belongsTo(Comment::class,'comment_id','id');
    }
}
