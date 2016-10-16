<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class NewStudent extends Model
{
    protected $fillable = ['email', 'class_id', 'responsible'];
}
