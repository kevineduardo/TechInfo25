<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Database\Eloquent\Model;

class NewStudent extends Model
{
    protected $fillable = ['email', 'class_id', 'responsible'];

    public function teacher() {
    	return $this->belongsTo('App\Teacher', 'responsible', 'id');
    }
    // criar um metodo q diz se esse email está registrado ou não, para assim na page de alunos
    // podermos verificar se o aluno foi registrado ou não
    public function classe() {
    	return $this->belongsTo('App\Classe', 'class_id', 'id');
    }
}
