<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
class Question extends Model
{
    //model config

    public $timestamps = false;
    protected $table = 'questions';
    protected $primaryKey = 'id_question';
    protected $fillable = ['title', 'option_a', 'option_b', 'option_c',
        'correct_option', 'points', 'isCustom', 'fk_id_quiz'];
    // fk_id_quiz could be null if the question wasn't custom
    // (created by an user)

    // relationship with randomquiz


    // rules for validation
    public static function rules(): array
    {
        return [
            'title' => 'required|string|max:60|unique:questions',
            'option_a' => 'required|string|max:30',
            'option_b' => 'required|string|max:30',
            'option_c' => 'required|string|max:30',
            'correct_option' => 'required|string',
            'points' => 'int|max:100',
            'isCustom' => 'required|boolean',
            'fk_id_quiz' => 'integer|digits_between:1,20'
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

