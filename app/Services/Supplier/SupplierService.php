<?php

    namespace App\Services\Supplier;

    use App\Http\Resources\Supplier\SupplierResource;
    use App\Repositories\Supplier\SupplierRepository;
    use Exception;

    class SupplierService
    {
        private $supplierRepository;

        /**
         * ---------------------------------------------------
         * handdle construct for call repositories
         * ---------------------------------------------------
         * @param SupplierRepsitory $supplierRepository
         */
        public function __construct(SupplierRepository $supplierRepository)
        {
            $this->supplierRepository = $supplierRepository;   
        }

        /**
         * -------------------------------------------------
         * function for creating new supplier in db
         * -------------------------------------------------
         * @param array $data
         * 
         * @return [type]
         */
        public function store(array $data)
        {
            try {
                $supplier = $this->supplierRepository->create($data); //create new supplier 
            } 
            catch (Exception $exception) {
                return response()->json([
                    'message' => "Une erreur est survenue lors de la création du fournisseur.",
                    'error' => $exception->getMessage(),
                ],500);
            }

            //return created supplier data
            return response()->json([
                'message' => "Fournisseur ajouté avec succès.",
                'supplier' => $supplier,
            ],201);
        }

        /**
         * -----------------------------------------------
         * function for retrieving a specific supplier
         * -----------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $supplier = $this->findSupplier($id); //find supplier to show

            //return supplier data
            return response()->json([
                'message' => "Résultat correspondant :",
                'supplier' => $supplier,
            ],200);
        }

        /**
         * --------------------------------------------------
         * function for updating a specific supplier data
         * --------------------------------------------------
         * @param mixed $id
         * @param array $data
         * 
         * @return [type]
         */
        public function update($id,array $data)
        {
            try {
                $findSupplier = $this->findSupplier($id); //find supplier to update

                $this->supplierRepository->update($findSupplier->id,$data); //update supplier data
    
                $supplier = new SupplierResource($findSupplier); // create new supplier resource
            } 
            catch (Exception $exception) {
                return response()->json([
                    'message' => "Une erreur est survenue lors de la mise des informations du fournisseur.",
                    'error' => $exception->getMessage(),
                ],500);
            }
            
            //return updated data as resource
            return response()->json([
                'message' => "Informations mise à jour avec succès.",
                'supplier' => $supplier,
            ],200);
        }

        /**
         * -------------------------------------------------------
         * function for deleting a specific supplier form db
         * --------------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findSupplier = $this->findSupplier($id); //find supplier to delete

            $this->supplierRepository->delete($findSupplier->id); //delete supplier

            //return success deleting message
            return response()->json([
                'message' => "Le fournisseur {$findSupplier->name} a été supprmé avec succès.",
            ],200);
        }

        /**
         * ----------------------------------------------------
         * function for getting all supplier list from db
         * ----------------------------------------------------
         * @return [type]
         */
        public function getAll()
        {
            $supplier = $this->supplierRepository->all(); //get all supplier list

            //return supplier list
            return response()->json([
                'message' => "Liste de tous les founisseurs :",
                'supplier' => $supplier,
            ],200);
        }

        /**
         * --------------------------------------------------
         * private function for finding supplier
         * --------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        private function findSupplier($id)
        {
            $supplier = $this->supplierRepository->find($id); //find supplier

            //verify if $supplier match in db
            if(!$supplier){
                throw new Exception('Cet fournisseur n\'existe pas.'); //throw error when supplier doesn't exist
            }
            return $supplier;
        }
    }