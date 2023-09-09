<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Optional;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //relasi many-to-many dengan model Role
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    // relasi 1 to M ke tabel like
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // relasi 1 to M  ke tabel post
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // relasi 1 to m ke tabel saved
    public function saveds(): HasMany
    {
        return $this->hasMany(Saved::class);
    }

    // relasi 1 to M ke tabel follow
    public function followings(): HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    public function customers()
    {
        return $this->hasMany(Order::class,'customer_id');
    }

    public function artists()
    {
        return $this->hasMany(Order::class,'artist_id');
    }

    // relasi 1 to M ke tabel commision
    public function commisions(): HasMany
    {
        return $this->hasMany(Commision::class);
    }

    // untuk mengecheck apakah user sudah follow atau belum
    public function getIsUserFollowerAttribute()
    {
        return $this->followers->contains('follower_id', auth()->user()->id);
    }

}
