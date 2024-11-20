<?php

    namespace App\Services\Manager;

use App\Http\Resources\Manager\ManagerResource;
use App\Models\User;
use App\Repositories\Manager\ManagerRepository;
    use App\Repositories\Auth\AuthRepository;
    use Exception;
    use Illuminate\Http\Request;

use function Laravel\Prompts\error;

    class ManagerService
    {
        private $managerRepository;
        private $authRepository;

        /**
         * --------------------------------------------------------------
         * handdle constructor for manager service to call nedeed repositories
         * --------------------------------------------------------------
         * @param ManagerRepository $managerRepository
         * @param AuthRepository $authRepository
         */
        public function __construct(ManagerRepository $managerRepository, AuthRepository $authRepository)
        {
            $this->managerRepository = $managerRepository;
            $this->authRepository = $authRepository;
        }

        /**
         * ------------------------------------------------------------
         * function for creating a new manager associate to an user
         * ------------------------------------------------------------
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
                        'lastname',
                        'firstname',
                        'phone',
                    ]);
                    $userData['type'] = 'manager';
                    $user = $this->authRepository->create($userData); //store user data
                    
                    $managerData = $request->only([
                        'address',
                    ]);
                    $managerData['user_id'] = $user->id;

                    //verify the user data isn't null
                    if(is_null($user)){
                        return 'Une erreur est survenu.';
                    }
                    $manager = $this->managerRepository->create($managerData); //store admin data   
            } 
            catch (Exception $exception) {
                return $exception;
            }

            //return data store
            return response()->json([
                'message' => 'Compte créer avec succès.',
                'user' => $user,
                'manager' => $manager,
            ],201);
        }

        /**
         * -------------------------------------------------
         * find a specific admin by id
         * -------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $manager = $this->managerRepository->find($id); //find manager

            //check that the $manager isn't null
            if(is_null($manager)){
                return response()->json([
                    'message' => "Aucun résultat correspondant.",
                ],404);
            }

            //return retrieve manager
            return response()->json([
                'message' => "Résultat correspondant :",
                'manager' => $manager,
            ],200);
        }

        /**
         * ---------------------------------------------------
         * function for updating a specific manager info
         * ---------------------------------------------------
         * @param mixed $id
         * @param Request $request
         * 
         * @return [type]
         */
        public function update($id, Request $request)
        {
            try {
                    $findManager = $this->managerRepository->find($id); //find manager to update

                    //check that this data isn't null
                    if(is_null($findManager)){
                        return response()->json([
                            'error' => 'Cet utilisateur n\'esxite pas.',
                        ],404);
                    }
                    $userData = $request->only([
                        'email',
                        'password',
                        'lastname',
                        'firstname',
                        'phone',
                    ]);
                    $this->authRepository->update($findManager->user_id,$userData); //update user data

                    $managerData = $request->only([
                        'address',
                    ]);
                    $this->managerRepository->update($id, $managerData); //update manager data

                    $data = new ManagerResource($this->managerRepository->find($id)); //create new ManagerResource

            } catch (Exception $exception) {
                return $exception;
            }

            //return data updated as resource
            return response()->json([
                'message' => "Informations mise à  avec succès.",
                'data' => $data,
            ],200);
        }

        /**
         * ----------------------------------------------------
         * function for deleting a specific manager account
         * ----------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findManager = $this->managerRepository->find($id); //find manager to delete

            //check that data isn't null
            if(is_null($findManager)){
                return response()->json([
                    'message' => "Cet utilisateur n'existe pas.",
                ],404);
            }
            $this->authRepository->delete($findManager->user_id); //delete userManager

            //return success delete message
            return response()->json([
                'message' => "Compte supprimé avec succès.",
            ],200);
        }

        /**
         * ----------------------------------------------------------
         * get all manager liste
         * ----------------------------------------------------------
         * @return [type]
         */
        public function getAll()
        {
            $manager = $this->managerRepository->all(); //get all manager in database to show

            //check that $manager isn't null
            if(is_null($manager)){
                return response()->json([
                    'message' => "Aucun manager enregistré pour le moment.",
                ],200);
            }

            //return list
            return response()->json([
                'message' => "Liste des tous les managers.",
                'managers' => $manager,
            ],200);
        }

    }