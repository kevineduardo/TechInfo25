<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPageAttr extends Model
{
    protected $table = "categories_pages";
    protected $fillable = ['page_id', 'category_id'];

    public function page() {
    	return $this->belongsTo('App\Page');
    }

    public function category() {
    	return $this->belongsTo('App\Categorie');
    }
}
