<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable =[
        'user_id',
        'address',
    ];

    protected $with = ['user']; //load user data automaticly

    /**
     * -------------------------------------------------------
     * define inherit relation with User model
     * -------------------------------------------------------
     * @return [type]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
