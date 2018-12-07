<?php
// Copyright (C) 2016  Kevin Souza
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\URL;

use App\Http\Requests;
use App\Page;
use App\Picture;
use App\Calendar;
use App\News;


class SiteController extends Controller
{
    public function inicio() {

        //$inicio = Cache::tags('início')->get('início');
        //if ($inicio != null) {
        //    return $inicio;
        //}

        $fotos = Picture::where('type', 0)->get();
        $calendario = Calendar::latest()->take(5)->get();
        $note = News::where('published',1)->latest()->take(5)->get();
        $not = [];
        foreach ( $note as $nt => $nv ) {
            if ( $nt > 4 ) { break; }
            preg_match_all( '$<img [^>]*src="([^"]+)"[^>]*>$', $nv->text, $m);
            if(count($m)>1&&count($m[1])>0) {
                $not[] = [ 'noticia' => $nv, 'imagem' => $m[1][0] ];
            }
        }
        if (count($not)==0) {
            $not[] = [ 'empty' => True ];
        }
        return view('inicio', ['calendario' => $calendario, 'fotos' => $fotos, 'noticias' => $not]);
    }

    public function pagina($id) {

        //$pg = Cache::tags('páginas')->get('páginas:' . $id);
        if ($pg != null) {
            return $pg;
        }

        $pagina = Page::with('author')->with('editor')->find($id);
        if(!$pagina) {
            abort(404);
        }
        return view('pagina', $pagina);
    }
}