<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Fans;
use App\Models\ReviewPhoto;
class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];
    protected $fillable = [
        'content',
        'user_id',
        'fans_id'
    ];
    public function fans()
    {
        return $this->belongsTo(Fans::class,'fans_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function review_photos()
    {
        return $this->hasMany(ReviewPhoto::class,'comment_id','id');
    }
}
