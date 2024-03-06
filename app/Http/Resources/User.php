<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'user_id' => $this->id,
            'user_lastname' => ucwords($this->lastname),
            'user_firstname' => ucwords($this->firstname),
            'user_email' => $this->email,
            'user_matricule' => $this->matricule,
            'email_verified_at' => $this->email_verified_at,
            'user_img' => $this->img != '' ? asset("storage/avatars/{$this->img}") : null,
            'user_state' => $this->state,
            'user_role' => $this->role,
            'user_remembertoken' => $this->remember_token,
            'user_created_at' => $this->created_at ? $this->created_at->format('Y-m-d H-i-s') : null,
            'user_updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H-i-s') : null,
        ];
    }
}
