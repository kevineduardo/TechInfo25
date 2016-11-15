<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['number', 'variant', 'inityear'];

    protected $dates = ['inityear', 'created_at', 'updated_at'];

    public function teachers() {
    	return $this->belongsToMany('App\Teacher', 'teacher_subject_class', 'class_id', 'teacher_id');
    }

    public function subjects() {
    	return $this->belongsToMany('App\Subject', 'teacher_subject_class', 'class_id', 'subject_id');
    }
}
