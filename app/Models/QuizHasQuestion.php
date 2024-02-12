<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizHasQuestion extends Model
{
    //use HasFactory;

    protected $table = 'quiz_has_questions';
    protected $primaryKey = ['id_quiz', 'id_question'];

    protected $fillable = ['id_quiz', 'id_question'];
    public function containedByQuiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz', 'id_quiz');
    }

    public function quizContainsThisQuestion()
    {
        return $this->belongsTo(Question::class, 'id_question', 'id_question');
    }



}
