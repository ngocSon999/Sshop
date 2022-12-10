<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderDetail extends Model
{
    use HasFactory;

    protected $table = 'oder_details';
    protected $fillable = [
        'oder_id',
        'product_id',
        'name',
        'image_path',
        'price',
        'quantity',
        'total_money',
        'pay_method',
        'status'
    ];
}
