<?php

namespace App\Http\Resources\Manager;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->user->email,
            'lastname' => $this->user->lastname,
            'firstname' => $this->user->firstname,
            'password' => $this->user->password,
            'phone' => $this->user->phone,

            'address' => $this->address,
        ];
    }
}
