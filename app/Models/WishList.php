<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;
    protected $table = 'wish_lists';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function fans()
    {
        return $this->belongsTo(Fans::class,'fan_id','id');
    }
}
