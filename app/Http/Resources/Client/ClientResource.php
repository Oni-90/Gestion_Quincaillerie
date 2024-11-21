<?php

    namespace App\Http\Resources\Client;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class ClientResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array
        {
            return [
                //user data
                'phone' => $this->user->phone,
                'email' => $this->user->email,
                'password' => $this->user->password,
                'firstname' => $this->user->firstname,
                'lastname' => $this->user->lastname,

                //client data
                'address' => $this->address,
            ];
        }
    }
