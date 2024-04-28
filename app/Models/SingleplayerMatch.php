<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class SingleplayerMatch extends Model
{
    // model config
    protected $table = 'singleplayer_matches';
    protected $primaryKey = 'id_match';
    protected $fillable = ['mode', 'id_match'];
    public $timestamps = false;

    // relationship with table match
    public function match()
    {
        return $this->belongsTo(Matchs::class, 'id_match');
    }

    // rules for validation
    public static function rulesForSingle(): array
    {
        return [
            'mode' => 'required|string|'. Rule::in(['quick', 'mirror', 'explod']),
            'id_match' => ['required', 'integer', 'digits_between:1,20']
        ];

    }
    public static function rulesForType(): array
    {
        return [
            'type' => 'required|string|', Rule::in(['single', 'multi']),
        ];

    }
}
