<?php

    namespace App\Repositories\Category;

    use App\Models\Category;
    use App\Repositories\Base\BaseRepository;

    class CategoryRepository extends BaseRepository
    {
        /**
         * ----------------------------------------------
         * handdle constructor for category repository
         * ----------------------------------------------
         * @param Category $category
         */
        public function __construct(Category $category)
        {
            parent::__construct($category);
        }
    }