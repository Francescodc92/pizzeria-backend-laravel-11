<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'full_image_path'
    ];

    public function getFullImagePathAttribute()
    {
        if($this->image){
            return asset('storage/'. $this->image );
        }

        return null;
    }
}
