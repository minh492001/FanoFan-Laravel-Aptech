<?php

namespace App\Models;

use App\Models\Fans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
class FanTypes extends Model
{
    use HasFactory;
    protected $table = 'fan_types';

    public function fans()
    {
        return $this->hasMany(
            Fans::class,
            'type_id',
            'id'
        );
    }
    public function articles()
    {
        return $this->hasMany(Article::class,'fan_types_id','id');
    }
}
