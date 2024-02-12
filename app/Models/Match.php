<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
