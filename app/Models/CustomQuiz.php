<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CustomQuiz extends Model
{
    // model config

    protected $table = 'custom_quizzes';
    protected $primaryKey  = 'id_quiz';
    public $timestamps = false;
    protected $fillable = ['quiz_name', 'id_quiz', 'fk_id_user'];

    // hierarchy relationship
    public function quiz()
    {
        return $this->belongsTo(Matchs::class, 'id_quiz');
    }

    //  relationship with question
    public function questions()
    {
        return $this->hasMany(Question::class, 'fk_id_quiz');
    }


    // rules for validation
    public static function rules(): array
    {
        return [
            'quiz_name' => 'required|string|max:40',
            'fk_id_user' => ['required', 'integer', 'digits_between:1,20'],
            'id_quiz' => ['required', 'integer', 'digits_between:1,20']
        ];
    }


}
