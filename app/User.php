<?php
// Copyright (C) 2016  Kevin Souza
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function teacher() {
        return $this->hasOne('App\Teacher');
    }

    public function pictures() {
        return $this->hasMany('App\Picture', 'author_id');
    }

    public function news() {
        return $this->hasMany('App\News', 'author_id');
    }

    public function editedNews() {
        return $this->hasMany('App\News', 'editor_id');
    }

    public function calendar() {
        return $this->hasMany('App\Calendar', 'author_id');
    }
}
