<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use App\Http\Requests\StoreNews;
use App\News;
use App\StudentNews;
use App\Teacher;
use Auth;

class PortalNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $professor = Teacher::where('user_id', $user->id)->first();
        if(!$professor) {
            $noticias = News::where('author_id', $user->id)->paginate(15);
            return view('portal.noticias', ['noticias' => $noticias,]);
        }
        // se for professor executa esse outro aqui e.e
        $noticias = News::paginate(15);
        return view('portal.noticias', ['noticias' => $noticias,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNews $request)
    {
        $user = Auth::user();
        $professor = Teacher::where('user_id', $user->id)->first();
        if(!$professor) {
            $noticia = new StudentNews();
            $noticia->fill($request->all());
            $noticia->author_id = $user->id;
        } else {
            $noticia = new News();
            $noticia->fill($request->all());
            $noticia->author_id = $user->id;
            $noticia->published_at = Carbon::now();
            if(str_contains($request->input('published'), 'true')) {
                $noticia->published = true;
            } else {
                $noticia->published = false;
                //$noticia->published_at = null;
            }
        }
        try {
            $noticia->save();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Erro ao salvar nova notícia no banco de dados.');
            if(env('APP_DEBUG', false)) {
                return response()->json([
                'message' => 'For some reason the data wasn\'t stored with success.',
                'debug_info' => $e,
                ], 422);
            } else {
                abort(503);
            }
        }
        $user = Auth::user();
        $professor = Teacher::where('user_id', $user->id)->first();
        if(!$professor) {
            $noticias = News::where('author_id', $user->id)->paginate(15);
            return view('portal.noticias', ['noticias' => $noticias, 'success' => true,]);
        }
        // se for professor executa esse outro aqui e.e
        $noticias = News::paginate(15);
        return view('portal.noticias', ['noticias' => $noticias, 'success' => true,]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}