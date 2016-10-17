<?php
// Copyright (C) 2016  Kevin Souza
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\Picture;
use App\Calendar;

class SiteController extends Controller
{
    public function inicio() {
    	$calendario = Calendar::take(4)->get();
    	return view('inicio', ['calendario' => $calendario,]);
    }

    public function pagina($id) {
    	$pagina = Page::with('author')->with('editor')->find($id);
    	if(!$pagina) {
    		abort(404);
    	}
    	return view('pagina', $pagina);
    }

    public function foto($id = 0) {
    	$foto = Picture::with('authors')->find($id);

    	if(!$foto) {
    		return redirect()->route('fotos');
    	}
    	return view('foto', $foto);
    }
}
