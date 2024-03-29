<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // use HasFactory;

    protected $table = 'likes';
    protected $primaryKey = 'id_like';
    protected $fillable = ['fk_id_user', 'fk_id_quiz'];
    public $timestamps = false;

}
