<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $fillable = ['teacher_id', 'subject_id', 'class_id', 'path'];

    protected $dates = ['deadline', 'created_at', 'updated_at'];

    public function teacher() {
    	return $this->belongsTo('App\Teacher');
    }

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function classe() {
    	return $this->belongsTo('App\Classe', 'class_id');
    }
}
