<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    public function teachers() {
    	return $this->belongsToMany('App\Teacher', 'teacher_subject_class', 'subject_id', 'teacher_id');
    }

    public function classes() {
    	return $this->belongsToMany('App\Classe', 'teacher_subject_class', 'subject_id', 'class_id');
    }
}
