<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Saved extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // relasi 1 to m tabel post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // relasi 1 to m tabel user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
