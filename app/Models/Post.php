<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category_id',
        'type_id',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    // relasi 1 to m tabel categories
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // relasi 1 to m tabel likes
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // relasi  1 to m tabel saveds
    public function saveds(): HasMany
    {
        return $this->hasMany(Saved::class);
    }

    // get is saved by user

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // relasi 1 to m tabel user

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    // get like count attribute

    public function getIsSavedAttribute()
    {
        return $this->saveds->contains('user_id', auth()->user()->id);
    }

    // get is likes by user

    public function getIsLikesAttribute()
    {
        return $this->likes->contains('user_id', auth()->user()->id);
    }
}
