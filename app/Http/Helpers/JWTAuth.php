<?php 
    
    namespace App\Http\Helpers;

    use App\Models\User;
    use Lcobucci\JWT\Configuration;
    use Lcobucci\JWT\Token\Plain;

    class JWTAuth 
    {
        private $jwtConfig;

        /**
         * @param Configuration $jwtConfig
         */
        public function __construct(Configuration $jwtConfig)
        {
            $this->jwtConfig = $jwtConfig;
        }


        /**
         * --------------------------------------------------
         * Function for token generating
         * --------------------------------------------------
         * @param mixed $user
         * @param mixed $type
         * @param mixed $time
         * 
         * @return [type]
         */
        public function generateToken($user, $type, $time)
        {
            $now = new \DateTimeImmutable();
            $exception = $type === 'access' ? $now->modify($time): $now->modify('+7 days');

            return $this->jwtConfig->builder()
                ->issuedBy(config('app.url'))
                ->permittedFor(config('app.url'))
                ->identifiedBy(bin2hex(random_bytes(16)))
                ->issuedAt($now)
                ->canOnlyBeUsedAfter($now)
                ->expiresAt($exception)
                ->withClaim('uid',$user->id)
                ->withClaim('username', $user->name)
                ->getToken($this->jwtConfig->signer(), $this->jwtConfig->signingKey())
                ->toString();
        }


        /**
         * --------------------------------------------------
         * Token expiration time generating
         * --------------------------------------------------
         * @param User $user
         * @param string $time
         * 
         * @return Plain
         */
        public function generateTokenExpiresAt(User $user, string $time): Plain
        {
            $now = new \DateTimeImmutable();
            $exception = $now->modify($time);

            return $this->jwtConfig->builder()
                ->issuedBy(config('app.url'))
                ->permittedFor(config('app.url'))
                ->identifiedBy(bin2hex(random_bytes(16)))
                ->issuedAt($now)
                ->canOnlyBeUsedAfter($now)
                ->expiresAt($exception)
                ->withClaim('uid',$user->id)
                ->getToken($this->jwtConfig->signer(), $this->jwtConfig->signingKey());
        }

    }