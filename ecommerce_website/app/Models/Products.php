<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'old_price',
        'category',
        'sub_category',
        'priority',
        'images',
        'video',
    ];
}
