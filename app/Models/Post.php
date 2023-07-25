<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // relasi 1 to m tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relasi 1 to m tabel likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // relasi  1 to m tabel saveds
    public function saveds()
    {
        return $this->hasMany(Saved::class);
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

    // get is saved by user

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get is likes by user

    public function getIsLikesAttribute()
    {
        return $this->likes->contains('user_id', auth()->user()->id);
    }
}
