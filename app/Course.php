<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'semester',
        'start_date',
        'active_date',
        'stop_date',
        'active_place',
        'course_name',
        'about',
        'tabs',
        'user_id',
        'views',
        'visits',
        'disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function matchmakings()
    {
        return $this->hasMany(Matchmaking::class);
    }
}
