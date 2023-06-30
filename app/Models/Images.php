<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fans;

class Images extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'images';
    protected $fillable = [
        'image',
        'fans_id',
    ];
    public function fans () {
        return $this->belongsTo(Fans::class);
    }
}
