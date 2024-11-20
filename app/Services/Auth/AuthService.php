<?php

    namespace App\Services\Auth;

    // use App\Http\Helpers\JWTAuth;
    use App\Http\Requests\Auth\AuthRequest;
    use App\Repositories\Auth\AuthRepository;
    use Exception;
    use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


    /**
     * [AuthService for all authentication methods]
     */
    class AuthService
    {
        private $authRepository;

        /**
         * --------------------------------------------
         * handdle constructor to call the repository
         * --------------------------------------------
         * @param AuthRepository $authRepository
         */
        public function __construct(AuthRepository $authRepository)
        {
            $this->authRepository = $authRepository;
        }



        /**
         * --------------------------------------------
         * define login method for user
         * --------------------------------------------
         * @param AuthRequest $request
         * 
         * @return [type]
         */
        public function login(AuthRequest $request)
        {
            $userForLogin = $this->authRepository->retrieveUserForLogin($request->email);

            if(!$userForLogin)
            {
                return response()->json([
                    'token' => '',
                    'message' => 'Email ou Mot de passe incorrecte.'
                ],404);
            }

            try {

                if($userForLogin && Hash::check($request['password'] ,$userForLogin->password))
                {
                    Auth::user();
                    // auth()->user();
                    $token = JWTAuth::fromUser($userForLogin);

                $cookie = cookie('jwt-token', $token, 60 * 24);
                }

                return response()->json([
                    'token' => $token,
                    'auth' => Auth::user(),
                    'message' => "Token généré pour l'authentification",
                    'cookie' => $cookie,
                ]);
            } catch (Exception $exception) {
                return response()->json([
                    'error' => $exception,
                ],400);
            }
        }



        /**
         * ----------------------------------------------
         * logout method handdling
         * ----------------------------------------------
         * @param mixed $request
         * 
         * @return [type]
         */
        public function logout($request)
        {
            try {
                Auth::logout();

                return response()->json([
                    'message' => "Déconnexion réeussi",
                    'success' => true,
                ],200);
            } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $exception) {
                return response()->json([
                    'message' => "Vous n'êtes pas authentifié",
                    'error' => $exception
                ],404);
            }
        }
    }