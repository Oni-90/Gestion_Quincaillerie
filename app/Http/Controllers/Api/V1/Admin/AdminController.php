<?php

    namespace App\Http\Controllers\Api\V1\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminRequest;
    use App\Http\Requests\Admin\UpdateAdminRequest;
    use App\Services\Admin\AdminService;

    class AdminController extends Controller
    {
        private $adminService;

        /**
         * ------------------------------------------------
         * handdle constructor for calling adminService
         * ------------------------------------------------
         * @param AdminService $adminService
         */
        public function __construct(AdminService $adminService)
        {
            $this->adminService = $adminService;
        }

        /**
         * ----------------------------------------------
         * function for creating new admin in db
         * ----------------------------------------------
         * @param AdminRequest $request
         * 
         * @return [type]
         */
        public function store(AdminRequest $request)
        {
            return $this->adminService->store($request);
        }

        /**
         * -------------------------------------------------
         * fuction for updating a specific userAdmin data
         * -------------------------------------------------
         * @param mixed $id
         * @param AdminRequest $request
         * 
         * @return [type]
         */
        public function update($id, UpdateAdminRequest $request)
        {
            return $this->adminService->update($id,$request);
        }

        /**
         * ----------------------------------------------
         * retrieve a specific userAdmin stored in db
         * ----------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->adminService->find($id);
        }

        /*
        *----------------------------------------------
         *function for deleting a specific userAdmin
         *---------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->adminService->delete($id);
        }

        /**
         * ----------------------------------------------
         * getAll admin stored in db
         * ----------------------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->adminService->getAll();
        }
    }
