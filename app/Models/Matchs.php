<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Matchs extends Model // match is a keyworn on php, so I've used matchs isntead of match
{

    protected $table = 'matches';

    protected $primaryKey = 'id_match';
    protected $fillable = ['type', 'fk_id_quiz'];

    public $timestamps = false;

    public static function rulesForMatch(): array
    {
        return [
            'type' => 'required|string|', Rule::in(['single', 'multi']),
            'fk_id_quiz' => ['required', 'integer', 'digits_between:1,20']
        ];

    }


}
