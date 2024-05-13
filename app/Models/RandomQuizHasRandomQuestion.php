<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomQuizHasRandomQuestion extends Model
{
    //model config

    public $timestamps = false;
    protected $table = 'random_quiz_has_random_question';
    //protected $primaryKey = ['id_question', 'id_quiz'];
    protected $fillable = ['id_question', 'id_quiz'];
    // Define the composite primary key
    protected $primaryKey = null;

    // Disable incrementing for composite primary key
    public $incrementing = false;

    // Get the primary key columns
    public function getKeyName()
    {
        return ['id_question', 'id_quiz'];
    }

    // relationship with table questions
    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }

    // rules for validation
    public static function rules(): array
    {
        return [
            'id_quiz' => 'integer|digits_between:1,20',
            'id_question' => 'integer|digits_between:1,20',
        ];
    }

}
