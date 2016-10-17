<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'type', 'bio', 'academic_bg'];
    public function classes() {
        return $this->belongsToMany('App\Classe', 'teacher_subject_class', 'teacher_id', 'class_id');
    }

    public function subjects() {
    	return $this->belongsToMany('App\Subject', 'teacher_subject_class', 'teacher_id', 'subject_id');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function newStudents() {
    	return $this->hasMany('App\NewStudent', 'responsible');
    }

    public function pages() {
        return $this->hasMany('App\Page', 'author_id');
    }

    public function editedPages() {
        return $this->hasMany('App\Page', 'editor_id');
    }
}
