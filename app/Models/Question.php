<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Question extends Model
{
    //use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id_question';
    protected $fillable = ['id_question', 'title', 'option_a', 'option_b', 'option_c',
        'correct_option', 'points'];


    public static function rules(): array
    {

        return [
            'title' => 'required|string|max:60',
            'option_a' => 'required|string|max:30',
            'option_b' => 'required|string|max:30',
            'option_c' => 'required|string|max:30',
            'correct_option' => 'required',
            'points' => 'required|integer'
            ];

    }
}

