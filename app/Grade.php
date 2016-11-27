<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['student_id', 'teacher_id', 'subject_id', 'class_id', 'grade'];

    protected $dates = ['created_at', 'updated_at'];

    public function teacher() {
    	return $this->belongsTo('App\Teacher');
    }

    public function student() {
    	return $this->belongsTo('App\Student');
    }

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function classe() {
    	return $this->belongsTo('App\Classe', 'class_id');
    }
}
