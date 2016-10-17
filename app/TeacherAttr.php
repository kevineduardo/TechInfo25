<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAttr extends Model
{
    protected $table = "teacher_subject_class";
    protected $fillable = ['teacher_id', 'subject_id', 'class_id'];
    public function teacher() {
    	return $this->belongsTo('App\Teacher');
    }

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function class() {
    	return $this->belongsTo('App\Classe');
    }
}
