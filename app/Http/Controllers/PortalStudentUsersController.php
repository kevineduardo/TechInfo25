<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Requests;
use App\Http\Requests\StoreNewStudents;
use App\User;
use App\NewStudent;
use App\Classe;
use Auth;

use Carbon\Carbon;

class PortalStudentUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyteacher');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($s = false, $d = false)
    {
        $alunos = NewStudent::with('classe', 'teacher.user')->paginate(15);
        return view('portal.usuarios_alunos', ['usuarios' => $alunos, 'success' => $s, 'deleted' => $d,]);
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
    public function store(StoreNewStudents $request)
    {
        $turma = Classe::find($request->input('class_id'));
        if($turma) {
            if($request->input('email')) {
            $novouser = new NewStudent();
            $novouser->fill($request->all());
            $novouser->responsible = Auth::user()->teacher->id;
            $novouser->created_at = Carbon::now();
            try {
                $novouser->save();
            } catch (\Illuminate\Database\QueryException $e) {
                Log::error('Erro ao salvar novo convite no banco de dados.');
                if(env('APP_DEBUG', false)) {
                    return response()->json([
                    'message' => 'For some reason the data wasn\'t stored with success.',
                    'debug_info' => $e,
                    ], 422);
                } else {
                    abort(503);
                }
            }
            return $this->index(true);
            }
        } else {
            abort(404);
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
            $aluno = NewStudent::find($id);
            if($aluno) {
                return response()->json($aluno->toArray());
            }
                
            return response()->json([
                'msg' => 'error.',
                ], 404);
        }
        return redirect()->route('usuários-alunos.index');
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
    public function update(Request $request)
    {
        $user = NewStudent::find($request->input('id'));
        if($user) {
            if($request->input('deletar')) {
                $user->delete();
                $this->index(false, true);
                // não tá aparecendo a msg de sucesso ao deletar
            }
        }
        return $this->index();
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
