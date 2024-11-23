<?php

    namespace App\Repositories\Supplier;

    use App\Repositories\Base\BaseRepository;
    use App\Models\Supplier;

    class SupplierRepository extends BaseRepository
    {
        /**
         * -----------------------------------------------
         * handdle constructor for supplier repository
         * -----------------------------------------------
         * @param Supplier $supplier
         */
        public function __construct(Supplier $supplier)
        {
            parent::__construct($supplier);
        }
    }