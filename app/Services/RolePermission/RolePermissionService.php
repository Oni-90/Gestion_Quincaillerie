<?php
    namespace App\Services\RolePermission;

    use App\Repositories\RolePermission\PermissionRepository;
    use App\Repositories\RolePermission\RoleRepository;

    class RolePermissionService
    {
        private $roleRepository;
        private $permissionRepository;

        /**
         * --------------------------------------------------------
         * handdle constructor for calling role and permission 
         * repository
         * --------------------------------------------------------
         * @param RoleRepository $roleRepository
         * @param PermissionRepository $permissionRepository
         */
        public function __construct(RoleRepository $roleRepository,PermissionRepository $permissionRepository)
        {
            $this->permissionRepository = $permissionRepository;
            $this->roleRepository = $roleRepository;
        }

        /**
         * --------------------------------------------
         * function for getting all existing roles
         * --------------------------------------------
         * @return [type]
         */
        public function getAllRole()
        {
            return $this->roleRepository->all();
        }

        /**
         * -------------------------------------------------
         * function for retreive all existing permissions 
         * -------------------------------------------------
         * @return [type]
         */
        public function getAllPermission()
        {
            return $this->permissionRepository->all();
        }
    }
