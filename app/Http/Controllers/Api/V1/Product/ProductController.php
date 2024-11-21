<?php

    namespace App\Http\Controllers\Api\V1\Product;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Product\ProductRequest;
    use App\Http\Requests\Product\UpdateProductRequest;
    use App\Services\Product\ProductService;

    class ProductController extends Controller
    {
        private $productService;

        /**
         * ----------------------------------------------
         * handdle constructor to call product service
         * ----------------------------------------------
         * @param ProductService $productService
         */
        public function __construct(ProductService $productService)
        {
            $this->productService = $productService;
        }

        /**
         * ------------------------------------------
         * create new product in db
         * ------------------------------------------
         * @param ProductRequest $request
         * 
         * @return [type]
         */
        public function store(ProductRequest $request)
        {
            $data = $request->validated();
            return $this->productService->store($data);
        }

        /**
         * ------------------------------------------
         * update a specific product info
         * ------------------------------------------
         * @param mixed $id
         * @param UpdateProductRequest $request
         * 
         * @return [type]
         */
        public function update($id,UpdateProductRequest $request)
        {
            $data = $request->validated();
            return $this->productService->update($id,$data);
        }

        /**
         * ----------------------------------------
         * find a specific product 
         * ----------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->productService->find($id);
        }

        /**
         * -------------------------------------------
         * delete specific product
         * -------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->productService->delete($id);
        }

        /**
         * -------------------------------------------
         * get all product list
         * -------------------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->productService->getAll();
        }
    }
