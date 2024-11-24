<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Admin extends User
    {
        use HasFactory;

        /**
         * Summary of fillable
         * @var array
         */
        protected $fillable =[
            'user_id',
            'username',
        ];

        protected $with = ['user']; //load user data automaticly

        /**
         * ------------------------------------------------
         * define inheri relation with User model
         * ------------------------------------------------
         * @return [type]
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
