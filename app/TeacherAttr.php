<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAttr extends Model
{
    protected $fillable = ['teacher_id', 'subject_id', 'class_id'];
}
