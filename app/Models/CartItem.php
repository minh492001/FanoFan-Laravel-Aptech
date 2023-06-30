<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fans;
class CartItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'cart_items';

    public function fans () {
        return $this->hasMany(Fans::class,'fan_id','id');
    }
}
