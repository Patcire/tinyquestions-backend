<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class RandomQuiz extends Model
{
    // model config
    protected $table = 'random_quizzes';
    protected $primaryKey  = 'id_quiz';
    public $timestamps = false;
    protected $fillable = ['id_quiz', 'mode'];

    // hierarchy relationship
    public function quiz()
    {
        return $this->belongsTo(Matchs::class, 'id_quiz');
    }


    // rules for validation
    public static function rules(): array
    {
        return [
            'id_quiz' => ['required', 'integer', 'digits_between:1,20'],
            'mode' => ['string', Rule::in('quick', 'explode', 'mirror')]
        ];
    }
}
