<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Category extends Model
    {
        use HasFactory;

        /**
         * Summary of fillable
         * @var array
         */
        protected $fillable =[
            'name',
            'description',
        ];

        /**
         * -------------------------------------
         * relationship with product
         * ------------------------------------
         * @return [type]
         */
        public function product()
        {
            return $this->hasMany(Product::class);
        }
    }
