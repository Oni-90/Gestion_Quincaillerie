<?php

    namespace App\Services\Order;

    use App\Http\Resources\Order\OrderResource;
    use App\Repositories\Order\OrderRepository;
    use App\Repositories\Product\ProductRepository;
    use Exception;
    use Illuminate\Http\Request;

    class OrderService
    {
        private $orderRepository;
        private $productRepository;

        /**
         * -----------------------------------------------
         * handdle constructor to call repositories
         * -----------------------------------------------
         * @param OrderRepository $orderRepository
         * @param ProductRepository $productRepository
         */
        public function __construct(OrderRepository $orderRepository,ProductRepository $productRepository)
        {
            $this->orderRepository = $orderRepository;
            $this->productRepository = $productRepository;
        }

        /**
         * ---------------------------------------------------
         * store new order and assoicate concerned products
         * ---------------------------------------------------
         * @param Request $request
         * 
         * @return [type]
         */
        public function store(Request $request)
        {
            try {
                    $orderData = $request->only([
                        'order_date',
                        'supplier_id',
                        'payment_status',
                    ]);
                    $orderData['total_amount'] = $this->calculteOrderTotalAmount($request['products']); //total amount calculating function
                    $order = $this->orderRepository->create($orderData); //create order
                    
                    //foreach loop to iterate on products array to associate product to order
                    foreach ($request['products'] as $productOrder) {
                        $product = $this->productRepository->find($productOrder['product_id']); //find product to associate to created order
        
                        $product->quantity += $productOrder['quantity_ordered']; //incremented product quantity with quantity_ordered 
                        $product->save(); //save the new quantity
        
                        //attach products selected to order
                        $this->orderRepository->attachProductToOrder($order,$product,[
                            'order_amount' => $product->price * $productOrder['quantity_ordered'],
                            'quantity_ordered' => $productOrder['quantity_ordered']
                            ]
                        );
                    }
            }
            catch (Exception $exception) {
                return response()->json([
                    'message' => "Une erreur est survenue lors de la création de la commande.",
                    'error' => $exception->getMessage(),
                ],500);
            }

            //return the created order with products associate
            return response()->json([
                'message' => "Commande créer avec succès.",
                'order' => $order->load('products'),
            ],201);
        }

        /**
         * --------------------------------------
         * find a specific order to show
         * --------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $order = $this->findOrder($id); //find order to show

            //return a retrieve order
            return response()->json([
                'message' => "Résultat correspondant :",
                'order' => $order,
            ],200);
        }

        /**
         * ------------------------------------------------------------------------
         * update a specific order informations and assoicate concerned products
         * -------------------------------------------------------------------------
         * @param mixed $id
         * @param Request $request
         * 
         * @return [type]
         */
        public function update($id,Request $request)
        {
           try {
                $findOrder = $this->findOrder($id); // find order to update

                $orderData = $request->only([
                    'order_date',
                    'supplier_id',
                    'payment_status',
                ]);
                $orderData['total_amount'] = $this->calculteOrderTotalAmount($request['products']); //total amount calculating function
                $this->orderRepository->update($findOrder->id,$orderData); //update order data

                //foreach loop to iterate on products array to associate product to order
                foreach ($request['products'] as $productOrder) {
                    $product = $this->productRepository->find($productOrder['product_id']); //find product to associate to updated order

                    $product->quantity += $productOrder['quantity_ordered']; //incremented product quantity with quantity_ordered 
                    $product->save(); //save the new quantity

                    //attach products selected to order
                    $this->orderRepository->attachProductToOrder($findOrder,$product,[
                        'quantity_ordered' => $productOrder['quantity_ordered'],
                        'order_amount' => $product->price * $productOrder['quantity_ordered'],
                        ]
                    );
                }
                $order = new OrderResource($findOrder); //create new order resource
            } 
            catch (Exception $exception) {
                return response()->json([
                    'message' => "Une erreur est survenue lors de la mise àjour de la commande.",
                    'error' => $exception->getMessage(),
                ],500);
           }

            //return updated order with pivot info
            return response()->json([
                'message'=> "Informations mise à jour avec succès.",
                'order' => $order,
            ],200);
        }

        /**
         * -----------------------------------------
         * delete a specific order from db
         * -----------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findOrder = $this->findOrder($id); //find order to delete

            $this->orderRepository->delete($findOrder->id); //delete order

            //return success deleting message
            return response()->json([
                'message' => "La commande numéro {$findOrder['order_number']} a été supprimée avec succès.",
            ],200);
        }

        /**
         * ---------------------------------------
         * get all order list
         * ---------------------------------------
         * @return [type]
         */
        public function getAll()
        {
            $order = $this->orderRepository->all(); //get all order list

            //return retrieve list
            return response()->json([
                'message' => "Liste de toutes les commandes :",
                'order' => $order,
            ],200);
        }

        /**
         * -------------------------------------------
         * private function to find order
         * -------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        private function findOrder($id)
        {
            $order = $this->orderRepository->find($id);

            if(!$order){
                throw new Exception('Cette commande n\'existe pas.');
            }
            return $order;
        }

        /**
         * -------------------------------------------------------
         * private function for calculating order total amount
         * -------------------------------------------------------
         * @param array $products
         * 
         * @return [type]
         */
        private function calculteOrderTotalAmount(array $products)
        {
            $totalAmount = 0; //initialize total amount var

            // iterate on products array to calculate total amount 
            foreach ($products as $productOrder) {
                $product = $this->productRepository->find($productOrder['product_id']); //find any product in the array

                $totalAmount += $product->price * $productOrder['quantity_ordered']; //calculate any product total amount and add them to get order total amount
            }
            return $totalAmount;
        }
    }