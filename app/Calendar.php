<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
    protected $fillable = ['name', 'description', 'place', 'role', 'related_class', 'author_id'];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function relatedClass() {
    	return $this->belongsTo('App\Classe', 'related_class');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'author_id');
    }
}
