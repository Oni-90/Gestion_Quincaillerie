<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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

            'username' => $this->username,
        ];
    }
}
