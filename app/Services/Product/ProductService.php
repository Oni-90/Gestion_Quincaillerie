<?php

    namespace App\Services\Product;

    use App\Http\Resources\Product\ProductResource;
    use App\Repositories\Product\ProductRepository;
    use Exception;

    class ProductService 
    {
        private $productRepository;

        /**
         * -------------------------------------------------
         * handdle constructor to call product repository
         * --------------------------------------------------
         * @param ProductRepository $productRepository
         */
        public function __construct(ProductRepository $productRepository)
        {
            $this->productRepository = $productRepository;
        }

        /**
         * ---------------------------------------------
         * function for creating new product
         * ---------------------------------------------
         * @param array $data
         * 
         * @return [type]
         */
        public function store(array $data)
        {
            try {
                $product = $this->productRepository->create($data); //store new product
            } 
            catch (Exception $exception) {
                return response()->json([
                    'message' => "Une erreur est survenue lors de la création du produit.",
                    'error' => $exception->getMessage(),
                ],500);
            }

            //return stored data
            return response()->json([
                'message' => "Produit créer avec succès.",
                'produit' => $product,
            ],201);
        }

        /**
         * ---------------------------------------
         * get a specific product
         * ---------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $product = $this->findProduct($id); //find product

            return response()->json([
                'message' => "Résultat correspondant :",
                'produit' => $product,
            ],200);
        }

        /**
         * ---------------------------------------------
         * function for updating a specific product
         * ---------------------------------------------
         * @param mixed $id
         * @param array $data
         * 
         * @return [type]
         */
        public function update($id, array $data)
        {
            try {
                $findProduct = $this->findProduct($id); //find product to update

                $this->productRepository->update($findProduct->id,$data); //update product
    
                $product = new ProductResource($findProduct); //create new product resource
            } 
            catch (Exception $exception) {
                return response()->json([
                    'message' => "Une erreur est survenue lors de la mise à jour du produit.",
                    'error' => $exception->getMessage(),
                ],500);
            }

            //return updated data as resource
            return response()->json([
                'message' => "Informations mise à avec succès.",
                'product' => $product,
            ],200);

        }

        /**
         * -----------------------------------------
         * function for deleting specific product
         * -----------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findProduct = $this->findProduct($id); //find product to delete

            $this->productRepository->delete($findProduct->id); //delete product

            return response()->json([
                'message' => "Le produit {$findProduct['name']} a été supprimé avec succès.",
            ],200);
        }

        /**
         * ----------------------------------------
         * get all products in database
         * ----------------------------------------
         * @return [type]
         */
        public function getAll()
        {
            $product = $this->productRepository->all(); //get all product in db

            return response()->json([
                'message' => "Liste de tous les produits :",
                'product' => $product,
            ],200);
        }

        /**
         * -----------------------------------------
         * private function for find product
         * -----------------------------------------
         * @param int $id
         * 
         * @return [type]
         */
        private function findProduct(int $id)
        {
            $product = $this->productRepository-> find($id); //find product

            if(!$product){
                throw new Exception('Cet produit n\'existe pas.'); //throw error if doesn't exist
            }
            return $product;
        }
    }