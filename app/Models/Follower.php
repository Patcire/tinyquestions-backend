<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //use HasFactory;

    protected $table = 'followers';
    protected $primaryKey = ['id_user_follow', 'id_user_followed'];
    protected $fillable = ['id_user_follow', 'id_user_followed'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'id_user_follow', 'id_user');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'id_user_followed', 'id_user');
    }


}
