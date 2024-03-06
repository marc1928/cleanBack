<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Questionnaire extends JsonResource
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
            'questionnaire_id' => $this->id,
            'questionnaire_name' => $this->name,
            'questionnaire_state' => $this->state,
            'questionnaire_created_at' => $this->created_at ? $this->created_at->format('Y-m-d H-i-s') : null,
            'questionnaire_updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H-i-s') : null,
        ];
    }
}
