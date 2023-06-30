<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FanTypes;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $fillable = [
        'title',
        'written_by',
        'content',
        'image',
        'fan_types_id',
    ];
    public function types()
    {
        return $this->belongsTo(FanTypes::class, 'fan_types_id', 'id');
    }
}
