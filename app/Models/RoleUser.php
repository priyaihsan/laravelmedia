<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'user_id',
    ];

    //relasi dengan model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relasi dengan model Role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

}
