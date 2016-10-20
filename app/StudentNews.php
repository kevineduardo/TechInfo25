<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class StudentNews extends Model
{
	use Filterable;
    protected $table = "students_news";
    protected $fillable = ['title', 'subtitle', 'text', 'author_id', 'tags'];

    protected $dates = ['created_at', 'updated_at'];

    public function author() {
    	return $this->belongsTo('App\User', 'author_id');
    }
}
