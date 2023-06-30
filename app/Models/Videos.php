<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $guarded = [];

    public function fans()
    {
        return $this->belongsTo(Fans::class, 'fans_id', "id");
    }
}
