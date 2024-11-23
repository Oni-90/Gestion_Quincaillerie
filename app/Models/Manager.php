<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Manager extends User
    {
        use HasFactory;

        protected $fillable = [
            'user_id',
            'address',
        ];

        protected $with = ['user']; //load user data automaticly

        /**
         * -------------------------------------------------------
         * define inherit relation between user model and manager 
         * --------------------------------------------------------
         * @return [type]
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
