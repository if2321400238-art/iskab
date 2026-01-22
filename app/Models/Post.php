<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'type',
        'title',
        'slug',
        'content',
        'thumbnail',
        'category_id',
        'author_id',
        'view_count',
        'is_popular',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_popular' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeBerita($query)
    {
        return $query->where('type', 'berita');
    }

    public function scopePenaSantri($query)
    {
        return $query->where('type', 'pena_santri');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }
}
