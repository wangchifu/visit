<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillJschool extends Model
{
    protected $fillable = [
        'jschool_code',
        'jschool_name',
        'disable',
    ];
}
