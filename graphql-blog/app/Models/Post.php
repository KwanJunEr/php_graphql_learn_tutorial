<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'published'
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
    return $query->where('published', true);
    }


}
