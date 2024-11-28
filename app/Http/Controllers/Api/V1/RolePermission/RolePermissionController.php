<?php

    namespace App\Http\Controllers\Api\V1\RolePermission;

    use App\Http\Controllers\Controller;
    use App\Services\RolePermission\RolePermissionService;

    class RolePermissionController extends Controller
    {
        private $rolePermissionService;

        /**
         * -------------------------------------------------
         * handdle constructor for calling role permission
         * service
         * -------------------------------------------------
         * @param RolePermissionService $rolePermissionService
         */
        public function __construct(RolePermissionService $rolePermissionService)
        {
            $this->rolePermissionService = $rolePermissionService;
        }

        /**
         * ----------------------------------
         * get all roles
         * ----------------------------------
         * @return [type]
         */
        public function getAllRoles()
        {
            return $this->rolePermissionService->getAllRole();
        }

        /**
         * -----------------------------------
         * get all permissions
         * -----------------------------------
         * @return [type]
         */
        public function getAllPermissions()
        {
            return $this->rolePermissionService->getAllPermission();
        }
    }
