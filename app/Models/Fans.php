<?php

namespace App\Models;

use App\Models\CartItem;
use App\Models\Comment;
use App\Models\TechnicalDetails;
use App\Models\Videos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\FanTypes;
use App\Models\Brands;
use App\Models\Images;
use App\Models\WishList;

class Fans extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    protected $table = 'fans';

    protected $fillable = [
        'name',
        'product_code',
        'price',
        'description',
        'about',
        'type_id',
        'brand_id',
        'technical_id'
    ];

    public function fanType()
    {
        return $this->belongsTo(FanTypes::class, 'type_id', 'id');
    }

    public function brands()
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'id');
    }

    public function technicals()
    {
        return $this->hasMany(TechnicalDetails::class, 'id', 'technical_id');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'fans_id', 'id');
    }

    public function carts()
    {
        return $this->belongsTo(CartItem::class, 'id', 'fan_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'fans_id', 'id');
    }

    public function wishlists()
    {
        return $this->hasMany(WishList::class, 'fan_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Videos::class, 'fans_id','id' );
    }
    public function reports()
    {
        return $this->hasMany(Report::class, 'fans_id','id' );
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
