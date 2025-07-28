<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
   protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = $category->slug ?? Str::slug($category->name);
        });
    }

    public function audios()
    {
        return $this->hasMany(Audio::class);
    }
}
