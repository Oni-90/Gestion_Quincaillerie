<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Client extends User
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

        /**
         * ----------------------------------------
         * relationship between client and sale
         * ----------------------------------------
         * @return [type]
         */
        public function sale()
        {
            return $this->hasMany(Sale::class);
        }
    }
