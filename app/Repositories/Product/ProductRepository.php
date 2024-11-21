<?php

    namespace App\Repositories\Product;

    use App\Models\Product;
    use App\Repositories\Base\BaseRepository;

    class ProductRepository extends BaseRepository
    {
        /**
         * ------------------------------------------------
         * handdle constructor for product repository
         * ------------------------------------------------
         * @param Product $product
         */
        public function __construct(Product $product)
        {
            parent::__construct($product);
        }
    }