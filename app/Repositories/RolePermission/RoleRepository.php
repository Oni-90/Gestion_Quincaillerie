<?php

    namespace App\Repositories\RolePermission;

    use App\Repositories\Base\BaseRepository;
    use Spatie\Permission\Models\Role;

    class RoleRepository extends BaseRepository
    {
        /**
         * ------------------------------------------
         * handdle constructor for role repository
         * ------------------------------------------
         * @param Role $role
         */
        public function __construct(Role $role)
        {
            parent::__construct($role);
        }
    }