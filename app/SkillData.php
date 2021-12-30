<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillData extends Model
{
    protected $fillable = [
        'skill_id',
        'career_id',
        'course',
        'excellent',
    ];
}
