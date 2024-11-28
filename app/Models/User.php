<?php

    namespace App\Models;

    // use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
    use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable implements JWTSubject
    {
        use HasFactory, Notifiable, HasRoles;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'email',
            'password',
            'firstname',
            'lastname',
            'phone',
            'type',
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * Get the attributes that should be cast.
         *
         * @return array<string, string>
         */
        protected function casts(): array
        {
            return [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
            ];
        }

        /**
         * Get the identifier that will be stored in the subject claim of the JWT.
         * @return [type]
         */
        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        /**
         * Return a key value array, containing any custom claims to be added to the JWT.
         * @return array
         */
        public function getJWTCustomClaims(): array
        {
            return [];
        }

        /**
         * -------------------------------------------------
         * define inherit relation with Admin model
         * -------------------------------------------------
         * @return [type]
         */
        public function admin()
        {
            return $this->hasOne(Admin::class);
        }

        /**
         * -----------------------------------------------------
         * define inherit relation with Client model
         * -----------------------------------------------------
         * @return [type]
         */
        public function client ()
        {
            return $this->hasOne(Client::class);
        }

        /**
         * -----------------------------------------------------
         * define inherit between user and manager model
         * -----------------------------------------------------
         * @return [type]
         */
        public function manager()
        {
            return $this->hasOne(Manager::class);
        }
    }
