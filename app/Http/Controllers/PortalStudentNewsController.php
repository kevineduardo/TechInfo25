<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ModStudentNews;
use App\Http\Middleware\VerifyTeacher;
use App\News;
use App\StudentNews;

use Carbon\Carbon;

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
    public function index($s = false, $d = false)
    {
        // aqui é pra mostrar a lista de noticias esperando por aprovação de um professor
        $noticias = StudentNews::paginate(15);
        return view('portal.noticia_alunos', ['noticias' => $noticias, 'success' => $s, 'deleted' => $d]);
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
        $alunonoticia = StudentNews::find($request->input('id'));
        if($alunonoticia) {
            if($request->input('publicar')) {
                $alunonoticia->fill($request->all());
                $noticia = new News();
                $noticia->fill($alunonoticia->toArray());
                $noticia->published = true;
                $noticia->published_at = Carbon::now();
                try {
                    $noticia->save();
                    $alunonoticia->delete();
                } catch (\Illuminate\Database\QueryException $e) {
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
            } else {
                $alunonoticia->delete();
                return $this->index(false, true);
            }
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->ajax()) {
            $noticia = StudentNews::find($id);
            if($noticia) {
                return response()->json($noticia->toArray());
            }
                
            return response()->json([
                'msg' => 'error.',
                ]);
        }
        return redirect()->route('notícias-alunos.index');
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
