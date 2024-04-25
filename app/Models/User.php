<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
    ];

    protected $attributes = [
        'points' => 0,
        'quizzes_resolved' => 0,
    ];

    public static function rulesForUsers(): array
    {
        return [
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|string|max:100|email|unique:users',
            'password' => 'required|string|max:30',

        ];
    }

    public static function rulesForUpdateUsers(): array
    {
        return [
            'username' => 'sometimes|required|string|max:30|unique:users,username',
            'email' => 'sometimes|required|string|max:100|unique:users,email',
            'password' => 'sometimes|string|max:30',
        ];
        }



}
