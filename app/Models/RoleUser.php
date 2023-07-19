<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable=[
        'role_id',
        'user_id',
    ];

        //relasi dengan model User
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        //relasi dengan model Role
        public function role()
        {
            return $this->belongsTo(Role::class);
        }

}
