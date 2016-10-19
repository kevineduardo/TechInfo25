<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentNews extends Model
{
    protected $table = "students_news";
    protected $fillable = ['title', 'subtitle', 'text', 'author_id', 'tags'];

    protected $dates = ['created_at', 'updated_at'];

    public function author() {
    	return $this->hasOne('App\User', 'id');
    }
}
