<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'duration',
        'plays',
        'description',
        'cover_image',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'duration' => 'integer',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function incrementPlays()
    {
        $this->increment('plays');
    }
}
