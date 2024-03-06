<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as ResourcesUser;
use Carbon\Carbon;

class Notification extends JsonResource
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
            'notification_id' => $this->id,
            'notification_content' => $this->content,
            'notification_user_id' => $this->user_id,
            'notification_state' => $this->state,
            'notification_created_at' => $this->created_at ? Carbon::parse($this->created_at)->isoFormat('MMMM D, YYYY | HH[h]mm') : null,
            'notification_updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H-i-s') : null,
            'user' => new ResourcesUser($this->whenLoaded('user')),
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i') : null,
        ];
    }
}
