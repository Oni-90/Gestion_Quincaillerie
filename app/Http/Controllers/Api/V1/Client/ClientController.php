<?php

    namespace App\Http\Controllers\Api\V1\Client;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Client\ClientRequest;
    use App\Http\Requests\Client\UpdateClientRequest;
    use App\Services\Client\ClientService;

    class ClientController extends Controller
    {
        private $clientService;

        /**
         * ----------------------------------------------------
         * define constructor to call client service
         * ----------------------------------------------------
         * @param ClientService $clientService
         */
        public function __construct(ClientService $clientService)
        {
            $this->clientService = $clientService;
        }

        /**
         * ----------------------------------------------------
         * create new client in db
         * ----------------------------------------------------
         * @param ClientRequest $request
         * 
         * @return [type]
         */
        public function store(ClientRequest $request)
        {
            return $this->clientService->store($request);
        }

        /**
         * -----------------------------------------------------
         * update a userClient data 
         * -----------------------------------------------------
         * @param mixed $id
         * @param ClientRequest $request
         * 
         * @return [type]
         */
        public function update($id,UpdateClientRequest $request)
        {
            return $this->clientService->update($id,$request);
        }

        /**
         * -----------------------------------------------------
         * find a specific client stored in db
         * -----------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function show($id)
        {
            return $this->clientService->find($id);
        }

        /**
         * --------------------------------------------------
         * destroy a userClient
         * --------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function destroy($id)
        {
            return $this->clientService->delete($id);
        }

        /**
         * ---------------------------------------------------
         * getAll client list
         * ---------------------------------------------------
         * @return [type]
         */
        public function index()
        {
            return $this->clientService->getAll();
        }
    }
