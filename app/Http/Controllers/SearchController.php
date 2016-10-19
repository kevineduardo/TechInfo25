<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;

class SearchController extends Controller
{
    public function newsSearch(Request $request) {
    	// tem q verificar se na rota tem "alunos"
        $request = $request->all();
        unset($request['_token']);
        $search = News::filter($request)->paginateFilter();
        return view('portal.noticias',['noticias' => $search,]);
    }
    public function alunosUserSearch(Request $request) {
    	
    }
}
