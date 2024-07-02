<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements JWTSubject
{
    // model config
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'email',
        'password',
        'points',
        'quizzes_resolved',
    ];
    protected $hidden = [
        'password',
    ];

    protected $attributes = [
        'points' => 0,
        'quizzes_resolved' => 0,
    ];


    // relationship with table Matches
    public function matches():BelongsToMany
    {
        return $this->belongsToMany(Matchs::class, 'users_plays_matches', 'id_user', 'id_match');
    }

    // rules for validation
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

    // for auth

    use \Illuminate\Auth\Authenticatable;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

}
