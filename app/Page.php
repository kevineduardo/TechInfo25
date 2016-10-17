<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['id', 'title', 'text', 'navbar_icon', 'type', 'custom_url', 'author_id', 'edited', 'editor_id', 'tags'];

    public function author() {
    	return $this->belongsTo('App\User', 'author_id');
    }

    public function editor() {
    	return $this->belongsTo('App\User', 'editor_id');
    }

    public function category() {
    	$this->belongsToMany('App\Categorie', 'categories_pages', 'page_id', 'category_id');
    }
}
