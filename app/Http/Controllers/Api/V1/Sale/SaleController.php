<?php

    namespace App\Http\Controllers\Api\V1\Sale;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Sale\SaleRequest;
    use App\Http\Requests\Sale\UpdateSaleRequest;
    use App\Services\Sale\SaleService;

    class SaleController extends Controller
    {
        private $saleService;

        /**
         * ----------------------------------------------
         * handdle constructor for calling services
         * ----------------------------------------------
         * @param SaleService $saleService
         */
        public function __construct(SaleService $saleService)
        {
            $this->saleService = $saleService;
        }

        /**
         * ----------------------------
         * store new sale
         * ----------------------------
         * @param SaleRequest $request
         * 
         * @return [type]
         */
        public function store(SaleRequest $request)
        {
            $request->validated();
            return $this->saleService->store($request);
        }

        /**
         * -----------------------------
         * update a sale
         * -----------------------------
         * @param mixed $id
         * @param UpdateSaleRequest $request
         * 
         * @return [type]
         */
        public function update($id,UpdateSaleRequest $request)
        {
            $request->validated();
            return $this->saleService->update($id,$request);
        }

        /**
         * --------------------------------
         * show a sale
         * --------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->saleService->find($id);
        }

        /**
         * -----------------------------------
         * destroy a sale
         * -----------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->saleService->delete($id);
        }

        /**
         * -----------------------------------
         * get all sales
         * -----------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->saleService->getAll();
        }
    }
