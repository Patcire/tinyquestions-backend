<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiplayerMatch extends Model
{
    // model config
    protected $table = 'multiplayer_matches';
    protected $primaryKey = 'id_match';
    protected $fillable = ['winner', 'number_players', 'id_match'];
    public $timestamps = false;

    // relationship with table match
    public function match()
    {
        return $this->belongsTo(Matchs::class, 'id_match');
    }

    // rules for validation
    public static function rulesForMulti(): array
    {
        return [
            'winner' => 'required|string|max:30',
            'id_match' => ['required', 'integer', 'digits_between:1,20'],
            'number_players' => 'required|integer|max:4'
        ];

    }
}
