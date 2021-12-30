<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matchmaking extends Model
{
    protected $fillable = [
        'situation',
        'user_id',
        'visit_id',
        'course_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
