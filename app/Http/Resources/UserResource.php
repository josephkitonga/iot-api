<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'role' => (string) $this->role,
            'active' => (boolean) $this->activation_status == 1 ? true : false,
            'is_logged_in' => (boolean) $this->is_logged_in == 1 ? true : false,
            'email_verified_at' => (string) $this->email_verified_at,
            'last_login' => (string) $this->last_login,
            'date_added' => (string) $this->created_at,
            'verified_at' => (string) $this->email_verified_at
        ];
    }
}
