<?php

    namespace App\Services\Admin;

    use App\Http\Resources\Admin\AdminResource;
    use App\Models\User;
    use App\Repositories\Admin\AdminRepository;
    use App\Repositories\Auth\AuthRepository;
    use Exception;
    use Illuminate\Http\Request;

    class AdminService
    {
        private $adminRepository;
        private $authRepository;


        /**
         * -----------------------------------------------------------
         * function for handdle a constructor to call a repository
         * -----------------------------------------------------------
         * @param AdminRepository $adminRepository
         * @param AuthRepository $authRepository
         */
        public function __construct( AdminRepository $adminRepository, AuthRepository $authRepository)
        {
            $this->adminRepository = $adminRepository;
            $this->authRepository = $authRepository;

        }



        /**
         * ------------------------------------------------------
         * function for creating a new user admin
         * ------------------------------------------------------
         * @param Request $request
         * 
         * @return [type]
         */
        public function store(Request $request)
        {
            try {
                $userData = $request->only([
                    'email',
                    'lastname',
                    'firstname',
                    'password',
                    'phone',
                ]);
                $userData['type'] = 'admin';
                $user = $this->authRepository->create($userData); //store user data
    
                $adminData = $request->only([
                    'username',
                ]);
                $adminData['user_id'] = $user->id;

                if(is_null($user)){
                    return response()->json([
                        'erreur' => "Une erreur est survenue",
                    ],400);
                }
                $admin = $this->adminRepository->create($adminData); //store admin data
                
            } catch (Exception $exception) {
                return $exception;
            }

            //return stored data
            return response()->json([
                'message' => "Compte admin créer avec succès.",
                'user' => $user,
                'admin' => $admin,
            ],201);    
        }

        /**
         * ----------------------------------------------------
         * find a specific admin by id
         * ----------------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function find($id)
        {
            $admin = $this->adminRepository->find($id); //find admin

            //ensure that $admin isn' null
            if(is_null($admin)){
                return response()->json([
                    'message' => "Aucun résultat correspondant.",
                ],404);
            }

            //return retrieve admin
            return response()->json([
                'message' => "Résultat correspondant :",
                'admin' => $admin,
            ],200);
        }

        /**
         * --------------------------------------------------------------
         * function to update admin's data
         * --------------------------------------------------------------
         * @param mixed $id
         * @param Request $request
         * 
         * @return [type]
         */
        public function update($id, Request $request)
        {
            try {
                    $findAdmin = $this->adminRepository->find($id); //find admin to update

                    //check that $findAdmin isn't null
                    if(is_null($findAdmin)){
                        return response()->json([
                            'error' => "Cet utilisateur n'existe pas."
                        ],404);
                    }
                    $userData = $request->only([
                        'email',
                        'lastname',
                        'firstname',
                        'password',
                        'phone',
                    ]);
                    $this->authRepository->update( $findAdmin->user_id,$userData); //update user data

                    $adminData = $request->only([
                        'username',
                    ]);
                    $this->adminRepository->update($id,$adminData); //update admin data

                    $data = new AdminResource($this->adminRepository->find($id)); //create new adminResource

            } catch (Exception $exception) {
                    return $exception;
            }

            //return updated data as resource
            return response()->json([
                'message' => "Informations mise à jour avec succès.",
                'data' => $data,
            ],200);
        }

        /**
         * ----------------------------------------------
         * function for deleting a specific admin
         * ----------------------------------------------
         * @param mixed $id
         * 
         * @return [type]
         */
        public function delete($id)
        {
            $findAdmin = $this->adminRepository->find($id); //find admin to delete

            //chech that this admin data isn't null
            if(is_null($findAdmin)){
                return response()->json([
                    'error' => "Cet utilisateur n'existe pas.",
                ],404);
            }
            $this->authRepository->delete($findAdmin->user_id); //delete userAdmin

            //retrun success message
            return response()->json([
                'message' => "Compte supprimé avec succès."
            ],200);
        }

        /**
         * --------------------------------------------------
         * get all admin liste
         * --------------------------------------------------
         * @return [type]
         */
        /**
         * @return [type]
         */
        public function getAll()
        {
           $admin = $this->adminRepository->all(); //retrieve all admin existing in db

           //check that admin isn't null
           if(is_null($admin)){
                return response()->json([
                    'message' => "Aucun admin enregistré pour le moment.",
                ],200);
           }

           //return list
           return response()->json([
                'message' => "Liste de tous les admins :",
                'admins' => $admin,
           ],200);
        }
    }