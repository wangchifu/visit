<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitData extends Model
{
    protected $fillable = [
        'user_id',
        'matchmaking_id',
        'visit_date',
        'teachers',
        'students',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function matchmaking()
    {
        return $this->belongsTo(Matchmaking::class);
    }
}
