<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CustomQuiz extends Model
{
    // use HasFactory;

    protected $table = 'custom_quizzes';
    protected $primaryKey  = 'id_quiz';

    protected $fillable = ['n_questions', 'type', 'clock',
        'time', 'fk_id_user'];

    public static function rules(): array
    {
        return [
            'n_questions' => 'required|integer',
            'type' => ['required', 'string', Rule::in(['custom'])],
            'clock' => 'required|boolean',
            'time' => 'integer|min:5'
        ];
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function quiz()
    {
        return $this->morphOne(Quiz::class, 'quizType');
    }


}
