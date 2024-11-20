<?php

    namespace App\Http\Controllers\Api\V1\Category;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Category\CategoryRequest;
    use App\Http\Requests\Category\UpdateCategoryRequest;
    use App\Services\Category\CategoryService;

    class CategoryController extends Controller
    {
        private $categoryService;

        /**
         * ----------------------------------------------
         * handdle constructor to call categoryService
         * ----------------------------------------------
         * @param CategoryService $categoryService
         */
        public function __construct(CategoryService $categoryService)
        {
            $this->categoryService = $categoryService;
        }

        /**
         * --------------------------------------------------
         * function for creating new category
         * --------------------------------------------------
         * @param CategoryRequest $request
         * 
         * @return [type]
         */
        public function store(CategoryRequest $request)
        {
            $data = $request->validated();
            return $this->categoryService->store($data);
        }

        /**
         * ------------------------------------------------
         * function for updating a category
         * ------------------------------------------------
         * @param mixed $id
         * @param UpdateCategoryRequest $request
         * 
         * @return [type]
         */
        public function update($id,UpdateCategoryRequest $request)
        {
            $data = $request->validated();
            return $this->categoryService->update($id,$data);
        }

        /**
         * ---------------------------------------------
         * find an specific category
         * ---------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->categoryService->find($id);
        }

        /**
         * ---------------------------------------------
         * function for deleting a specific category
         * ---------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->categoryService->delete($id);
        }

        /**
         * ------------------------------------------------
         * function for retrieving all categories in db
         * ------------------------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->categoryService->getAll();
        }
    }
