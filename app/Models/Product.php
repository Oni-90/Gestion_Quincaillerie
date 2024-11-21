<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'store_location',
        'alert_threshold',
        'unit',
        'slug',
        'quantity',
        'category_id',
    ];

    protected $with = ['category']; //load category data automaticly

    // protected $guarded = [];

    /**
     * ------------------------------------
     * relationship with category
     * ------------------------------------
     * @return [type]
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
