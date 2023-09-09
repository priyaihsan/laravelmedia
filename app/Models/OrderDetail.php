<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'commision_id',
        'quantity',
        'price_per_item',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function commision() : BelongsTo
    {
        return $this->belongsTo(Commision::class);
    }
}
