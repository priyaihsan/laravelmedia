<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // relasi  1 to m ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi 1 to m ke tabel post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
