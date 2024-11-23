<?php

    namespace App\Http\Controllers\Api\V1\Order;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Order\OrderRequest;
    use App\Http\Requests\Order\UpdateOrderRequest;
    use App\Services\Order\OrderService;

    class OrderController extends Controller
    {
        private $orderService;

        /**
         * --------------------------------------
         * handdle constructor to call services
         * --------------------------------------
         * @param OrderService $orderService
         */
        public function __construct(OrderService $orderService)
        {
            $this->orderService = $orderService;
        }

        /**
         * -------------------------------------
         * store new order
         * -------------------------------------
         * @param OrderRequest $request
         * 
         * @return [type]
         */
        public function store(OrderRequest $request)
        {
            $request->validated();
            return $this->orderService->store($request);
        }

        /**
         * ----------------------------------------
         * update a order
         * ----------------------------------------
         * @param mixed $id
         * @param UpdateOrderRequest $request
         * 
         * @return [type]
         */
        public function update($id,UpdateOrderRequest $request)
        {
            $request->validated();
            return $this->orderService->update($id,$request);
        }

        /**
         * --------------------------------
         * show a order
         * --------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->orderService->find($id);
        }

        /**
         * -----------------------------------
         * destroy a order
         * -----------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->orderService->delete($id);
        }

        /**
         * ------------------------------
         * get all orders
         * ------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->orderService->getAll();
        }
    }
