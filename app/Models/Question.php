<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'choice_one',
        'choice_two',
        'choice_three',
        'choice_four',
        'response',
        'questionnaire_id',
        'state'
    ];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }
}
