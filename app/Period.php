<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{

    protected $fillable = [
        'name', 'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student','student_period');
    }
}
