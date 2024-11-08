<?php

    namespace App\Repositories\Base\Interfaces;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Collection;

    /**
     * Summary of BaseInterfaceForEloquentRepository
     * ------------------------------------
     * Eloquent interface 
     * -------------------------------------
     */
    interface BaseInterfaceForEloquentRepository
    {
        /**
         * Summary of create
         * @param array $attributes
         * @return \Illuminate\Database\Eloquent\Model
         */
        public function create(array $attributes): Model;


        /**
         * Summary of find
         * @param mixed $id
         * @return void
         */
        public function find($id): ?Model;

        
        /**
         * Summary of all
         * @return \Illuminate\Support\Collection
         */
        public function all(): Collection;


        /**
         * Summary of update
         * @param mixed $id
         * @param array $attributes
         * @return void
         */
        public function update($id, array $attributes);


        /**
         * Summary of delete
         * @param mixed $id
         * @return void
         */
        public function delete($id);


        /**
         * Summary of findByOtherColumn
         * @param string $field
         * @param mixed $value
         * @return Model
         */
        public function findByOtherColumn(string $field, $value);
    }