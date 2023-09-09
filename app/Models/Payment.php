<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'payment_method',
        'payment_amount',
        'payer_information',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
