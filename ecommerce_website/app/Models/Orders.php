<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'address',
        'order_details',
        'shipping',
        'notes',
        'status',
        'total',
        'tracking_id',
        'phone_payment',
    ];
}
