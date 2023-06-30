<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table = 'brands';

    public function fans()
    {
        return $this->hasMany(
            Fans::class,
            'brand_id',
            'id'
        );
    }


}
