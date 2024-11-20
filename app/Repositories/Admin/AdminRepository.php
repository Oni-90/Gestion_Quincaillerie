<?php

    namespace App\Repositories\Admin;

    use App\Models\Admin;
    use App\Repositories\Base\BaseRepository;


    class AdminRepository extends BaseRepository
    {
        /**
         * -------------------------------------------------
         * handdle constructor for admin repository
         * ------------------------------------------------- 
         * @param Admin $admin
         */
        public function __construct(Admin $admin)
        {
            parent::__construct($admin);
        }
    }