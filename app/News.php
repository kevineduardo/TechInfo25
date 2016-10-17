<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'subtitle', 'text', 'published', 'author_id', 'edited', 'editor_id', 'tags'];

    public function authors() {
    	return $this->belongsTo('App\User', 'author_id');
    }
    public function editors() {
    	return $this->belongsTo('App\User', 'editor_id');
    }
}
