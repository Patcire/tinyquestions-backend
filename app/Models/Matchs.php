<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Validation\Rule;

class Matchs extends Model // match is a keyworn on php, so I've used matchs isntead of match
{
    // model config
    protected $table = 'matches';
    protected $primaryKey = 'id_match';
    protected $fillable = ['isMultiplayer', 'winner', 'number_players', 'fk_id_quiz'];
    public $timestamps = false;

    // relationship with table user
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_plays_matches', 'id_user', 'id_match');

    }

    // relationship with table quiz
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'fk_id_quiz', 'id_quiz');

    }

    public function randomQuiz()
    {
        return $this->belongsTo(RandomQuiz::class, 'fk_id_quiz', 'id_quiz');
    }

    public function customQuiz()
    {
        return $this->belongsTo(RandomQuiz::class, 'fk_id_quiz', 'id_quiz');
    }


    // rules for validation
    public static function rulesForMatch(): array
    {
        return [
            'fk_id_quiz' => ['required', 'integer', 'digits_between:1,20'],
            'isMultiplayer' => ['required', 'boolean'],
            'winner' => ['string', 'max:30'],
            'number_players' => [ 'string', 'max:1'],
        ];

    }

}
