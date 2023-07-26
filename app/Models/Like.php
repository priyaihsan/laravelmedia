<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // relasi  1 to m ke tabel user
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // relasi 1 to m ke tabel post
    public function post() :BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
