<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function classe() {
    	return $this->hasOne('App\ClasseAttr');
    }
}
