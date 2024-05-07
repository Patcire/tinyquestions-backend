<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlayMatch extends Model{

    protected $table = 'users_plays_matches';
    protected $primaryKey = 'id_user_plays_match';
    public $timestamps = false;
    protected $fillable = [
        'id_user',
        'id_match' ,
        'points' ,
        'answers',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function match()
    {
        return $this->belongsTo(Matchs::class, 'id_match');
    }


    public static function rules(): array
    {
        return [
            'id_user' => 'required', 'integer', 'digits_between:1,20',
            'id_match' => 'required', 'integer', 'digits_between:1,20',
            'points' => 'required|integer',
            'answers' => 'required|json',
        ];
    }
    public static function idRules(): array
    {
        return [
            'id_user' => 'required', 'integer', 'digits_between:1,20',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($userPlayMatch) {
            $userPlayMatch->date = now();
        });
    }

}
