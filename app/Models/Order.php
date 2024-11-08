<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable =[
        'product_id',
        'supplier_id',
        'total_amount',
        'order_date',
        'payment_status',
    ];
}
