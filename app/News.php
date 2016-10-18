<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	use Filterable;
    protected $fillable = ['title', 'subtitle', 'text', 'published', 'author_id', 'edited', 'editor_id', 'tags'];
    protected $dates = ['published_at', 'created_at', 'updated_at'];

    public function author() {
    	return $this->belongsTo('App\User', 'author_id');
    }
    public function editor() {
    	return $this->belongsTo('App\User', 'editor_id');
    }
}
