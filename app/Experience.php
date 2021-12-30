<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'matchmaking_id',
        'user_id',
        'experience',
    ];

    public function matchmaking()
    {
        return $this->belongsTo(Matchmaking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
