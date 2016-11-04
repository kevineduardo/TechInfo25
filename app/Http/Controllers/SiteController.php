<?php
// Copyright (C) 2016  Kevin Souza
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Http\Requests;
use App\Page;
use App\Picture;
use App\Calendar;
use App\News;

class SiteController extends Controller
{
    public function inicio() {

        $inicio = Cache::tags('início')->get('início');
        if ($inicio != null) {
            return $inicio;
        }

        $fotos = Picture::where('type', 0)->get();
        $calendario = Calendar::take(4)->get();
        return view('inicio', ['calendario' => $calendario, 'fotos' => $fotos,]);
    }

    public function pagina($id) {

        $pg = Cache::tags('páginas')->get('páginas:' . $id);
        if ($pg != null) {
            return $pg;
        }

        $pagina = Page::with('author')->with('editor')->find($id);
        if(!$pagina) {
            abort(404);
        }
        return view('pagina', $pagina);
    }

    public function foto($id = 0) {
        $foto = Picture::with('authors')->where('type', 0)->find($id);

        if(!$foto) {
            return redirect()->route('inicio');
        }
        return view('foto', $foto);
    }
}