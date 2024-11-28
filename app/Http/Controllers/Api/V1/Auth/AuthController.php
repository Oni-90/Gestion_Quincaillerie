<?php

    namespace App\Http\Controllers\Api\V1\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Auth\AuthRequest;
    use App\Services\Auth\AuthService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class AuthController extends Controller
    {
        private $authService;

        /**
         * -----------------------------------------
         * handdle constructor for call sertvices
         * -----------------------------------------
         * @param AuthService $authService
         */
        public function __construct(AuthService $authService)
        {
            $this->authService = $authService;
        }

        /**
         * -----------------------------------
         * login method
         * ----------------------------------
         * @param Request $request
         * 
         * @return [type]
         */
        public function login(AuthRequest $request)
        {
            return $this->authService->login($request);
        }

        /**
         * -------------------------------------
         * logout method
         * -------------------------------------
         * @param mixed $request
         * 
         * @return [type]
         */
        public function logout()
        {
            return $this->authService->logout();
        }

        /**
         * return all authenticated user notifications
         * @return [type]
         */
        public function getNotification()
        {
            return response()->json(Auth::user()->notifications);
        }
    }
