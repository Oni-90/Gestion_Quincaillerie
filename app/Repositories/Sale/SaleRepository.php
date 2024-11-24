<?php

    namespace App\Repositories\Sale;

    use App\Models\Product;
    use App\Models\Sale;
    use App\Repositories\Base\BaseRepository;

    class SaleRepository extends BaseRepository
    {
        /**
         * ----------------------------------------------
         * handdle constructor for sale repository
         * ----------------------------------------------
         * @param Sale $sale
         */
        public function __construct(Sale $sale)
        {
            parent::__construct($sale);
        }

        /**
         * ---------------------------------------------------
         * repository function to attach product to sale
         * ---------------------------------------------------
         * @param Sale $sale
         * @param Product $product
         * @param mixed $attributes
         * 
         * @return [type]
         */
        public function attachProductTosale(Sale $sale,Product $product,$attributes)
        {
            return $sale->products()->attach($product,$attributes);
        }
    }