<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'fullname' => $this->firstName . ' ' . $this->lastName,
            'email' => $this->email,
        ];
    }
}
