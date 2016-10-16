<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'type', 'bio', 'academic_bg'];

    public function classes() {
    	return $this->belongsTo('App\SchoolClass');
    }

    public function subjects() {
    	return $this->belongsTo('App\Subject');
    }
}
