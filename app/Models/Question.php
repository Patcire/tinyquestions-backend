<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
class Question extends Model
{

    public $timestamps = false;
    protected $table = 'questions';
    protected $primaryKey = 'id_question';
    protected $fillable = ['title', 'option_a', 'option_b', 'option_c',
        'correct_option'];


    public static function rulesForUsers(): array
    {

        return [
            'title' => 'required|string|max:60',
            'option_a' => 'required|string|max:30',
            'option_b' => 'required|string|max:30',
            'option_c' => 'required|string|max:30',
            'correct_option' => 'required',
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

