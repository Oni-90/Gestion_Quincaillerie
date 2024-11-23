<?php

    namespace App\Http\Controllers\Api\V1\Supplier;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Supplier\SupplierRequest;
    use App\Http\Requests\Supplier\UpdateSupplierRequest;
    use App\Services\Supplier\SupplierService;

    class SupplierController extends Controller
    {
        private $supplierService;

        /**
         * ----------------------------------------------
         * handdle constructor to call services
         * ----------------------------------------------
         * @param SupplierService $supplierService
         */
        public function __construct(SupplierService $supplierService)
        {
            $this->supplierService = $supplierService;
        }

        /**
         * ------------------------
         * store new supplier
         * ------------------------
         * @param SupplierRequest $request
         * 
         * @return [type]
         */
        public function store(SupplierRequest $request)
        {
            $data = $request->validated();
            return $this->supplierService->store($data);
        }

        /**
         * ----------------------------
         * update supplier
         * ----------------------------
         * @param mixed $id
         * @param UpdateSupplierRequest $request
         * 
         * @return [type]
         */
        public function update($id,UpdateSupplierRequest $request)
        {
            $data = $request->validated();
            return $this->supplierService->update($id,$data);
        }

        /**
         * ----------------------------
         * show a supplier
         * ----------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->supplierService->find($id);
        }

        /**
         * -----------------------------
         * destroy a supplier
         * -----------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->supplierService->delete($id);
        }

        /**
         * --------------------------------
         * get all suppliers
         * --------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->supplierService->getAll();
        }
    }
