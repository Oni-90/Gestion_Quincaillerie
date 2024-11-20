<?php

    namespace App\Http\Controllers\Api\v1\Manager;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Manager\ManagerRequest;
use App\Http\Requests\Manager\UpdateMangerRequest;
use App\Services\Manager\ManagerService;

    class ManagerController extends Controller
    {
        private $managerService;

        /**
         * ---------------------------------------------
         * handdle constructor for manager controller
         * ---------------------------------------------
         * @param ManagerService $managerService
         */
        public function __construct(ManagerService $managerService)
        {
            $this->managerService = $managerService;
        }

        /**
         * ---------------------------------------------
         * store function for creating new manager
         * ---------------------------------------------
         * @param ManagerRequest $request
         * 
         * @return [type]
         */
        public function store(ManagerRequest $request)
        {
            return $this->managerService->store($request);
        }

        /**
         * ------------------------------------------------
         * function for updating userManger Data
         * ------------------------------------------------
         * @param mixed $id
         * @param ManagerRequest $request
         * 
         * @return [type]
         */
        public function update($id, UpdateMangerRequest $request)
        {
            return $this->managerService->update($id,$request);
        }

        /**
         * -------------------------------------------------
         * retrieve a specific userManager in dataBase 
         * -------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->managerService->find($id);
        }

        /**
         * -------------------------------------------------
         * function for deleting userManager
         * -------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->managerService->delete($id);
        }

        /**
         * ---------------------------------------------------
         * getAll manager stored in db
         * ---------------------------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->managerService->getAll();
        }
    }
