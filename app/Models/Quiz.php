<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Quiz extends Model
{
   // use HasFactory;

    protected $table = 'quizzes';
    protected $primaryKey = 'id_quiz';

    protected $fillable = ['id_quiz', 'n_questions', 'type', 'clock', 'time'];

    public static function rules(): array
    {
        return [
            'n_questions' => 'required|integer',
            'type' => ['required', 'string', Rule::in(['custom', 'quick', 'mirror', 'exploding', 'zen'])],
            'clock' => 'required|boolean',
            'time' => 'integer|min:5'
        ];
    }

}
