<?php

    namespace App\Repositories\RolePermission;

    use App\Repositories\Base\BaseRepository;
    use Spatie\Permission\Models\Permission;

    class PermissionRepository extends BaseRepository
    {
        /**
         * ------------------------------------------------
         * handdle constructor for permission repository
         * ------------------------------------------------
         * @param Permission $permission
         */
        public function __construct(Permission $permission)
        {
            parent::__construct($permission);
        }
    }