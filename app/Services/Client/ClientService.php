<?php

    namespace App\Services\Client;

    use App\Http\Resources\Client\ClientResource;
    use App\Models\User;
    use App\Repositories\Client\ClientRepository;
    use App\Repositories\Auth\AuthRepository;
    use Exception;
    use Illuminate\Http\Request;
use Illuminate\Support\Js;

    class ClientService 
    {
        private $clientRepository;
        private $authRepository;

        /**
         * ----------------------------------------------
         * constructor to call clientRepository
         * ----------------------------------------------
         * @param ClientRepository $clientRepository
         * @param AuthRepository $authRepository
         */
        public function __construct(ClientRepository $clientRepository, AuthRepository $authRepository)
        {
            $this->clientRepository = $clientRepository;
            $this->authRepository = $authRepository;
        }

        /**
         * ----------------------------------------------------------------
         * function for stored a new client in dataBase
         * ----------------------------------------------------------------
         * @param Request $request
         * 
         * @return [type]
         */
        public function store(Request $request)
        {
           try {
                $userData = $request->only([
                    'email',
                    'password',
                    'firstname',
                    'lastname',
                    'phone',
                ]);
                $userData['type'] = 'client';
                $user = $this->authRepository->create($userData); //save user data

                $clientData = $request->only([
                    'address',
                ]);
                $clientData['user_id'] = $user->id;

                //verify if user is not null before create client
                if(is_null($user)){
                    return response()->json([
                        'erreur' => "Une erreur est survenue.",
                    ],400);
                }
                $client = $this->clientRepository->create($clientData); //save client data

           } catch (Exception $exception) {
                return $exception;
           }

           //return data stored
           return response()->json([
            'message' => 'Compte client créé avec succès.',
            'user' => $user,
            'client' => $client,
           ],201);
        }

        /**
         * --------------------------------------------------------
         * function retrieving a specific client
         * --------------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $client = $this->clientRepository->find($id); //find client
            if(is_null($client)){
                return response()->json([
                    'message' => "Aucun résultat correspondant.",
                ],404);
            }

            //return retrieve client
            return response()->json([
                'message' => "Résultat correspondant :",
                'client' => $client,
            ],200);
        }

        /**
         * ------------------------------------------------------------------
         * function for updating user data and client data
         * ------------------------------------------------------------------
         * @param mixed $id
         * @param Request $request
         * 
         * @return [type]
         */
        public function update($id,Request $request)
        {
            try {
                    $findClient = $this->clientRepository->find($id); //find client to update

                    //check if client retrieve isn't null
                    if(is_null($findClient)){
                        return response()->json([
                            'erreur' => "Cet utilisateur n'existe pas",
                        ],404);
                    }
                    $userData = $request->only([
                        'email',
                        'phone',
                        'password',
                        'firstname',
                        'lastname',
                    ]);
                    $this->authRepository->update($findClient->user_id,$userData); //update user data

                    $clientData = $request->only([
                        'address',
                    ]);
                    $this->clientRepository->update($id,$clientData); //update client data

                    $data = new ClientResource($this->clientRepository->find($id)); //create new ClientResource

            } catch (Exception $exception) {
                return $exception;
            }

            //return updated data as ressource
            return response()->json([
                'message' => "Informations mise à jour avec succès.",
                'data' => $data,
            ],200);
        }

        /**
         * ------------------------------------------------------
         * function for deleting specific userClient
         * ------------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findClient = $this->clientRepository->find($id); //find client to delete

            //ensure that the client exist before delete
            if(is_null($findClient))
            {
                return response()->json([
                    'erreur' => "cet utilisateur n'existe pas.",
                ],404);
            }
            $this->clientRepository->delete($findClient->user_id); //delete userClient

            return response()->json([
                'message' => "Compte supprimé avec succès.",
            ],200);
        }

        /**
         * ---------------------------------------------------------
         * retrieve all client list in dataBase
         * ---------------------------------------------------------
         * @return [type]
         */
        public function getAll()
        {
            $client = $this->clientRepository->all(); //retrieve all client in db

            //check that $client isn't null
            if(is_null($client)){
                return response()->json([
                    'message' => "Aucun client enregistré pour le moment.",
                ],200);
            }

            //return list
            return response()->json([
                'message' => "Liste de tous les clients.",
                'clients' => $client,
            ],200);
        }
    }