<?php

namespace App\Http\Resources;
use App\Http\Resources\Questionnaire as ResourcesQuestionnaire;
use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
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
            'question_id' => $this->id,
            'question_description' => $this->description,
            'question_choice_one' => $this->choice_one,
            'question_choice_two' => $this->choice_two,
            'question_choice_three' => $this->choice_three,
            'question_choice_four' => $this->choice_four,
            'question_response' => $this->response,
            'question_state' => $this->state,
            'question_created_at' => $this->created_at ? $this->created_at->format('Y-m-d H-i-s') : null,
            'question_updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H-i-s') : null,
            'questionnaire' => new ResourcesQuestionnaire($this->whenLoaded('questionnaire')),
        ];
    }
}
