<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // use HasFactory;

    protected $table = 'likes';
    protected $primaryKey = ['id_user', 'id_quiz'];
    protected $fillable = ['id_user', 'id_quiz'];

    public function likedBy()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function likesThisQuiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz', 'id_quiz');

    }

}
