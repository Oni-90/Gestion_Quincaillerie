<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;

    class Order extends Model
    {
        use HasFactory;

        /**
         * Summary of fillable
         * @var array
         */
        protected $fillable =[
            'supplier_id',
            'total_amount',
            'order_date',
            'payment_status',
            'order_number',
        ];

        protected $with = ['products','supplier']; //return order with supplier and product data

        /**s
         * ----------------------------------------------------------------
         * define relationship with product and call the pivot table
         * ----------------------------------------------------------------
         * @return [type]
         */
        public function products()
        {
            return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity_ordered','order_amount');
        }

        /**
         * ------------------------------------------------------------
         * define relationship with supplier table
         * ------------------------------------------------------------
         * @return [type]
         */
        public function supplier()
        {
            return $this->belongsTo(Supplier::class);
        }

        /**
         * ----------------------------------------------------------------------
         * boot for generating order number automaticly when creating new order
         * ----------------------------------------------------------------------
         * @return [type]
         */
        public static function boot()
        {
            parent::boot();

            static::creating(function($order){
                    do {
                        if(empty($order->order_number)){
                            $order_number = strtoupper(Str::random(3)).rand(100,999); //generate order number
                        }
                    } while (DB::table('orders')->where('order_number',$order_number)->exists()); //verify that the number is unique

                    $order->order_number = $order_number; //assign generate number to order_number column
            });
        }
    }
