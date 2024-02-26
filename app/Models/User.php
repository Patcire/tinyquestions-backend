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

    public static function rulesForUsers(): array
    {
        return [
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|string|max:100|unique:users',
            'password' => 'required|string|max:100',

        ];
    }
    public static function rulesForUpdateUsers(): array
    {
        return [
            'username' => 'sometimes|required|string|max:30|unique:users,username',
            'email' => 'sometimes|required|string|max:100|unique:users,email',
            'password' => 'sometimes|string|max:100',
        ];
        }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->points = 0;
            $user->quizzes_resolved=0;
        });
    }


}
