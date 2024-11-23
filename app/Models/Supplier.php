<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /**
     * ---------------------------------------------------------------
     * define relationship with order table
     * ---------------------------------------------------------------
     * @return [type]
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
