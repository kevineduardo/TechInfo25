<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use App\Http\Requests\StoreNews;
use App\News;
use App\StudentNews;

class PortalNoticiasData extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
     * Store a new user.
     *
     * @param  Request  $r
     * @return Response
     */
	function main(Request $request) {
		$noticia = StudentNews::find($request->input('id'));
		if($noticia) {
			return response()->json([
			'name' => $noticia['title'],
			'desc' => $noticia['subtitle'],
			'text' => $noticia['text'],
			]);
		}
			
		return response()->json([
			'msg' => 'error.',
			]);
	}
}
