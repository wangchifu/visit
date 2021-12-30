<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RebackSkill extends Model
{
    protected $fillable = [
        'username',
        'co_name',
        'class_num',
        'people_num',
        'situation',
        'skill_id',
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
