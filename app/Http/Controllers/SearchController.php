<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\StudentNews;
use App\User;
use App\NewStudent;

class SearchController extends Controller
{
    public function newsSearch(Request $request) {
    	if ( str_contains(\Request::route()->getName(), 'alunos') ) {
			$request = $request->all();
			unset($request['_token']);
			$search = StudentNews::filter($request)->paginateFilter();
			return view('portal.noticia_alunos',['noticias' => $search,]);
		} else {
			$request = $request->all();
			unset($request['_token']);
			$search = News::filter($request)->paginateFilter();
			return view('portal.noticias',['noticias' => $search,]);
		}
    }

    public function usersSearch(Request $request) {
    	$request = $request->all();
    	unset($request['_token']);
    	$search = User::filter($request)->paginateFilter();
    	return view('portal.usuarios', ['usuarios' => $search,]);
    }

    public function studentUsersSearch(Request $request) {
    	$request = $request->all();
    	unset($request['_token']);
    	$search = NewStudent::filter($request)->paginateFilter();
    	return view('portal.usuarios_alunos', ['usuarios' => $search,]);
    }
}
