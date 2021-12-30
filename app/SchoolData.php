<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolData extends Model
{
    protected $table = "school_datas";

    protected $fillable = [
        'school_code',
        'school_name',
        'kind',
        'title',
        'edu_key',
        'uid',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
