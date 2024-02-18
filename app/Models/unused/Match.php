<?php

namespace App\Models\unused;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //use HasFactory;

    protected $table = 'matches';

    protected $primaryKey = ['id_user', 'id_quiz'];
    protected $fillable = ['id_user', 'id_quiz', 'right_answers'];

    public function playedBy()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function userPlayThisQuiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz', 'id_quiz');
    }

}
