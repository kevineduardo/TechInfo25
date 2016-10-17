<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['id', 'name', 'icon'];

    public function pages() {
    	return $this->belongsToMany('App\Page', 'categories_pages', 'category_id', 'page_id');
    }
}
