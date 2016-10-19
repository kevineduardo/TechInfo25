<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;

class SearchController extends Controller
{
    public function newsSearch(Request $request) {
    	if ( str_contains(\Request::route()->getName(), 'alunos') ) {
			$request = $request->all();
			unset($request['_token']);
			$search = News::where("published",0)->filter($request)->paginateFilter();
			return view('portal.noticia_alunos',['noticias' => $search,]);
		} else {
			$request = $request->all();
			unset($request['_token']);
			$search = News::filter($request)->paginateFilter();
			return view('portal.noticias',['noticias' => $search,]);
		}
    }
    public function alunosUserSearch(Request $request) {
    	
    }
}
