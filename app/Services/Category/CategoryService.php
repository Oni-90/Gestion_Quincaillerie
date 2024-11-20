<?php

    namespace App\Services\Category;

use App\Http\Resources\Category\CategoryResource;
use App\Repositories\Category\CategoryRepository;
use Exception;

    class CategoryService
    {
        private $categoryRepository;

        /**
         * ------------------------------------------------------
         * handdle constructor to call categoryRepositoty
         * ------------------------------------------------------
         * @param CategoryRepository $categoryRepository
         */
        public function __construct(CategoryRepository $categoryRepository)
        {
            $this->categoryRepository = $categoryRepository;
        }

        /**
         * ------------------------------------------------
         * store new category in dataBase
         * ------------------------------------------------
         * @param array $data
         * 
         * @return [type]
         */
        public function store(array $data)
        {
            try {
                $category = $this->categoryRepository->create($data); //stored new category

            } catch (Exception $exception){
                return $exception;
            }
            
            //return stored data 
            return response()->json([
                'message' => "Catégorie créée avec succès.",
                'category' => $category,
            ],201);
        }

        /**
         * ---------------------------------------------
         * find an category by id
         * ---------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $category = $this->categoryRepository->find($id); //fins category

            //ensure that $category isn't null
            if(is_null($category)){
                return response()->json([
                    'message' => "Aucun résultat correspondant.",
                ],404);
            }

            //retrn retrieve category
            return response()->json([
                'message' => "Résultat correspondant :",
                'category' => $category,
            ],200);
        }

        /**
         * ------------------------------------------------
         * update a specific category 
         * ------------------------------------------------
         * @param mixed $id
         * @param array $data
         * 
         * @return [type]
         */
        public function update($id,array $data)
        {
          try {
                $findCategory = $this->categoryRepository->find($id); //get category to update

                //check that category exist before update
                if(is_null($findCategory)){
                    return response()->json([
                        'erreur' => "Cette catégorie n'existe pas.",
                    ],404);
                }
                $this->categoryRepository->update($id,$data); //update category data
                $category = new CategoryResource($this->categoryRepository->find($id)); //stored it as resource

          } catch (Exception $exception) {
            return $exception;
          }

            //return updated data as ressource
            return response()->json([
                'message' => "Informations mise à jour avec succès.",
                'data' => $category,
            ],200);
        }

        /**
         * ----------------------------------------------
         * delete a specific category
         * ----------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findCategory = $this->categoryRepository->find($id); //get category to delete

            //check that category exist before delete
            if(is_null($findCategory)){
                return response()->json([
                    'erreur' => "Cette catégorie n'existe pas.",
                ],404);
            }   

            return response()->json([
                'message' => "Catégorie supprimée avec succès.",
            ],200);
        }

        /**
         * ----------------------------------------------
         * get all categories stored in db
         * ----------------------------------------------
         * @return [type]
         */
        public function getAll()
        {
            $category = $this->categoryRepository->all(); //retrieve all categories in db

            //return data retrieve
            return response()->json([
                'message' => "Liste de toutes les catégorie avec succès :",
                'categories' => $category,
            ],200);
        }
    }