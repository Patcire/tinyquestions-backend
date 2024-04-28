<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Validation\Rule;

class Matchs extends Model // match is a keyworn on php, so I've used matchs isntead of match
{
    // model config
    protected $table = 'matches';
    protected $primaryKey = 'id_match';
    protected $fillable = ['type', 'fk_id_quiz'];
    public $timestamps = false;

    // relationship with table user
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // hierarchy relationship
    public function multiplayerMatch()
    {
        return $this->hasOne(MultiplayerMatch::class, 'id_match');
    }

    public function singleplayerMatch()
    {
        return $this->hasOne(SingleplayerMatch::class, 'id_match');
    }

    // rules for validation
    public static function rulesForMatch(): array
    {
        return [
            'type' => 'required|string|'. Rule::in(['single', 'multi']),
            'fk_id_quiz' => ['required', 'integer', 'digits_between:1,20']
        ];

    }

}
