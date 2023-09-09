<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
        'customer_id',
        'artist_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function artist()
    {
        return $this->belongsTo(User::class,'artist_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
