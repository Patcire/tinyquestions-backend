<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomQuestion extends Model
{
    public $timestamps = false;
    protected $table = 'custom_questions';
    protected $primaryKey = 'id_question';
    protected $fillable = ['title', 'option_a', 'option_b', 'option_c',
        'correct_option', 'fk_id_quiz'];


    public static function rules(): array
    {

        return [
            'title' => 'required|string|max:60|unique:questions',
            'option_a' => 'required|string|max:30',
            'option_b' => 'required|string|max:30',
            'option_c' => 'required|string|max:30',
            'correct_option' => 'required',
            'fk_id_quiz' => 'required'| 'integer',
        ];

    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            $question->points = 10;
        });
    }


}
