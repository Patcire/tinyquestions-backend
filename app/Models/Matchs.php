<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Validation\Rule;

class Matchs extends Model // match is a keyworn on php, so I've used matchs isntead of match
{
    // relationship with table user
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // model config
    protected $table = 'matches';
    protected $primaryKey = 'id_match';
    protected $fillable = ['type', 'fk_id_quiz'];
    public $timestamps = false;

    // rules for validation
    public static function rulesForMatch(): array
    {
        return [
            'type' => 'required|string|'. Rule::in(['single', 'multi']),
            'fk_id_quiz' => ['required', 'integer', 'digits_between:1,20']
        ];

    }
    public static function rulesForType(): array
    {
        return [
            'type' => 'required|string|', Rule::in(['single', 'multi']),
        ];

    }



}
