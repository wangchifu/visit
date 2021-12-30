<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'order_by',
        'title',
        'description',
        'type',
        'option',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
