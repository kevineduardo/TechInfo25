<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['title', 'description', 'path', 'ext_path', 'type', 'author_id'];

    public function authors() {
    	return $this->belongsTo('App\User', 'author_id');
    }
}
