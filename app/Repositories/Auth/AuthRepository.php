<?php 

    namespace App\Repositories\Auth;

    use App\Repositories\Base\BaseRepository;
    use App\Models\User;

    /**
     * Summary of AuthRepository
     */
    class AuthRepository extends BaseRepository
    {

        private $user;

        /**
         * Summary of __construct
         * @param \App\Models\User $user
         */
        public function __construct(User $user)
        {
            parent::__construct($user);
            $this->user= $user;
        }

        /**
         * ----------------------------------------------------------
         * Retrieve user for login 
         * ----------------------------------------------------------
         * @param mixed $email
         * @param mixed $password
         * 
         * @return [type]
         */
        public function retrieveUserForLogin($email)
        {
            $userForLogin = $this->user->where('email',$email)->first();

            return $userForLogin;
        }
        
    }