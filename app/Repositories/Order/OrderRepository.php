<?php

    namespace App\Repositories\Order;

    use App\Models\Order;
    use App\Models\Product;
    use App\Repositories\Base\BaseRepository;

    class OrderRepository extends BaseRepository
    {
        /**
         * ---------------------------------------------------
         * handdle constructor for order repository
         * ---------------------------------------------------
         * @param Order $order
         */
        public function __construct(Order $order)
        {
            parent:: __construct($order);
        }

        /**
         * --------------------------------------------
         * function for attach products to order
         * --------------------------------------------
         * @param Order $order
         * @param Product $product
         * @param mixed $attributes
         * 
         * @return [type]
         */
        public function attachProductToOrder(Order $order,Product $product, $attributes)
        {
            return $order->products()->attach($product,$attributes);
        }
    }