<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasseAttr extends Model
{
    protected $table = "classes_students";
    protected $fillable = ['id', 'student_id', 'class_id'];

    public function student() {
    	return $this->belongsTo('App\Student');
    }

    public function classe() {
    	return $this->belongsTo('App\Classe', 'class_id');
    }
}
