<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Middleware\VerifyTeacher;
use App\News;
use App\StudentNews;

class PortalStudentNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(VerifyTeacher::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($s = false)
    {
        // aqui é pra mostrar a lista de noticias esperando por aprovação de um professor
        $noticias = StudentNews::with('author')->paginate(15);
        return view('portal.noticia_alunos', ['noticias' => $noticias, 'success' => $s,]);
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
    public function store(Request $request)
    {
        //
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
        $alunonoticia = StudentNews::find($id);
        $noticia = new News();
        $noticia->fill($noticia);
        try {
            $noticia->save();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Erro ao salvar novo módulo no banco de dados.');
            if(env('APP_DEBUG', false)) {
                return response()->json([
                'message' => 'For some reason the data wasn\'t stored with success.',
                'debug_info' => $e,
                ], 422);
            } else {
                abort(422);
            }
        }
        return $this->index(true);
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

    public function api(Request $request) {
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
