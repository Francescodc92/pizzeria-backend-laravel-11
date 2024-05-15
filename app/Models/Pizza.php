<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'discount_percent',
        'available',
    ];

    protected $appends = [
        'full_image_path',
        'price_after_discount',
    ];

    public function getFullImagePathAttribute()
    {
        if($this->image){
            return asset('storage/'. $this->image );
        }

        return null;
    }

    public function getPriceAfterDiscountAttribute()
    {
    
        if ($this->discount_percent) {
            return $this->price - ($this->price * $this->discount_percent / 100);
        }

        return $this->price;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(OrderPizza::class);
    }
}
