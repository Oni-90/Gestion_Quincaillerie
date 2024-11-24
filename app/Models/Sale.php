<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;

    class Sale extends Model
    {
        protected $fillable = [
            'sale_number',
            'total_amount',
            'payment_status',
            'client_id',
        ];

        protected $with = ['products','client']; //load automaticly client and products data

        /**
         * ---------------------------------------------------
         * define relationship between sale and client
         * ---------------------------------------------------
         * @return [type]
         */
        public function client()
        {
            return $this->belongsTo(Client::class);
        }

        /**
         * ------------------------------------------------------------
         * define relationship with pivot between sale and product
         * ------------------------------------------------------------
         * @return [type]
         */
        public function products()
        {
            return $this->belongsToMany(Product::class,'product_sale')->withPivot('quantity_sold','sale_amount');
        }

        /**
         * ----------------------------------------------------------------------
         * boot for generating sale number automaticly when creating new sale
         * ----------------------------------------------------------------------
         * @return [type]
         */
        public static function boot()
        {
            parent::boot();

            static::creating(function($sale){
                    do {
                        if(empty($sale->sale_number)){
                            $sale_number = strtoupper(Str::random(4)).rand(10,99); //generate sale number
                        }
                    } while (DB::table('sales')->where('sale_number',$sale_number)->exists()); //verify that the number is unique

                    $sale->sale_number = $sale_number; //assign generate number to sale_number column
            });
        }
    }
