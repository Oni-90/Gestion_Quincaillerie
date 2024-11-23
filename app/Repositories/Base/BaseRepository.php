<?php

    namespace App\Repositories\Base;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use App\Repositories\Base\Interfaces\BaseInterfaceForEloquentRepository;

    /**
     * Summary of BaseRepository
     * ----------------------------------------
     * Base repository for all crud actions
     * ----------------------------------------
     */
    class BaseRepository implements BaseInterfaceForEloquentRepository
    {
        protected $model;

        /**
         * Summary of __construct
         * @param \Illuminate\Database\Eloquent\Model $model
         */
        public function __construct(Model $model)
        {
            $this->model = $model;
        }

        /**
         * Summary of create
         * @param array $attributes
         * @return \Illuminate\Database\Eloquent\Model
         */
        public function create(array $attributes): Model
        {
            return $this->model->create($attributes);
        }
        
        /**
         * Summary of update
         * @param mixed $id
         * @param array $attributes
         * @return bool
         */
        public function update($id, array $attributes)
        {
            return $this->model::where('id',$id)->update($attributes);
        }

        /**
         * Summary of find
         * @param mixed $id
         * @return Collection|Model|null
         */
        public function find($id): ?Model
        {
            return $this->model->find($id);
        }

        /**
         * Summary of all
         * @return Collection
         */
        public function all(): Collection
        {
            return $this->model->all();
        }

        /**
         * Summary of delete
         * @param mixed $id
         * @return bool|null
         */
        public function delete($id)
        {
            return $this->model->destroy($id);
        }

        /**
         * Summary of findByOtherColumn
         * @param mixed $field
         * @param mixed $value
         * @return mixed
         */
        public function findByOtherColumn($field, $value)
        {
           $result = $this->model::where($field,$value)->first();
           if(!$result){
                return false;
           } 

           return $result;
        }
    }