<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomQuiz extends Model
{
    // use HasFactory;

    protected $table = 'custom_quizzes';
    protected $primaryKey  = 'id_quiz';

    protected $fillable = ['n_questions', 'type', 'clock', 'time', 'fk_id_user'];


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

}
