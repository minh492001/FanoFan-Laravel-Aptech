<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fans;
class TechnicalDetails extends Model
{
    use HasFactory;

    protected $table = 'technical_details';

    public function fans()
    {
        return $this->belongsTo(Fans::class, 'technical_id', 'id');
    }

}
