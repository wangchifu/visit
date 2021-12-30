<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'visit_name',
        'about',
        'graduate',
        'views',
        'visits',
        'tabs',
        'user_id',
        'disable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchmakings()
    {
        return $this->hasMany(Matchmaking::class);
    }
}
