<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'semester',
        'username',
        'type',
        'career_ids',
    ];

    public function reback_skills()
    {
        return $this->hasMany(RebackSkill::class);
    }
}
