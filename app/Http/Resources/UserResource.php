<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uuid
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $email_verified_at
 * @property string $avatar
 * @property string $address
 * @property string $phone_number
 * @property string $is_marketing
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $last_login_at
 */
class UserResource extends JsonResource
{
    private string $token;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, string>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'avatar' => $this->avatar,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'is_marketing' => $this->is_marketing,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'last_login_at' => $this->last_login_at->format('Y-m-d H:i:s'),
            'token' => $this->when($this->token != null, $this->token),
        ];
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }
}
