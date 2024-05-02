<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

class Quiz extends Model
{
    // model config
    protected $table = 'quizzes';
    protected $primaryKey = 'id_quiz';
    public $timestamps = false;
    protected $fillable = [
        'number_questions',
        'clock',
        'time',
        'type'
    ];


    // relationship with table Matches
    public function custom(): HasMany
    {
        return $this->hasMany(Matchs::class, 'fk_id_quiz', 'id_quiz');
    }

    // hierarchy relationship
    public function customQuiz()
    {
        return $this->hasOne(CustomQuiz::class, 'id_quiz', 'id_quiz');
    }
    public function randomQuiz()
    {
        return $this->hasOne(CustomQuiz::class, 'id_quiz', 'id_quiz');
    }

    // rules for validation
    public static function rulesForQuizzes(): array
    {
        return [
            'number_questions' => 'required|integer',
            'clock' => 'required|boolean',
            'time' => 'required|integer|min:5',
            'type' => 'required|string|'. Rule::in(['custom', 'random'])

        ];
    }

}
