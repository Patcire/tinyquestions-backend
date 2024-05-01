<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomQuizHasRandomQuestion extends Model
{
    //model config

    public $timestamps = false;
    protected $table = 'random_quiz_has_random_question';
    protected $primaryKey = ['id_question', 'id_match'];
    protected $fillable = ['id_question', 'id_match'];

    // rules for validation
    public static function rules(): array
    {
        return [
            'id_quiz' => 'integer|digits_between:1,20',
            'id_match' => 'integer|digits_between:1,20',
        ];
    }

}
