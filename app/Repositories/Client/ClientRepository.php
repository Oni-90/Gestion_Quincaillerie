<?php

    namespace App\Repositories\Client;

    use App\Repositories\Base\BaseRepository;
    use App\Models\Client;

    class ClientRepository extends BaseRepository
    {
        /**
         * ----------------------------------------------
         * handdle constructor for client repository
         * ----------------------------------------------
         * @param Client $client
         */
        public function __construct(Client $client)
        {
            parent::__construct($client);
        }
    }