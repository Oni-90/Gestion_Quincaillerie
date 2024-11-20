<?php

    namespace App\Repositories\Manager;

    use App\Models\Manager;
    use App\Repositories\Base\BaseRepository;

    class ManagerRepository extends BaseRepository
    {
        /**
         * --------------------------------------------------------
         * handdle constructor for manager repository
         * --------------------------------------------------------
         * @param Manager $manager
         */
        public function __construct(Manager $manager)
        {
            parent::__construct($manager);
        }
    }