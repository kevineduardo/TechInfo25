<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\User;
use App\Student;
use App\Teacher;
use App\Classe;
use App\ClasseAttr;
use Auth;

class PortalUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyteacher:2');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($s = false, $d = false)
    {
        // essa página só pode ser acessada por professores
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $usuarios = User::paginate(15);
        $classes = Classe::all();
        return view('portal.usuarios', ['usuarios' => $usuarios, 'success' => $s, 'deletado' => $d, 'classes' => $classes,]);
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
    public function show(Request $request, $id)
    {
        if($request->ajax()) {
            $user = User::with('teacher')->find($id);
            if($user) {
                unset($user['oauth_id']);
                $ar = $user->toArray();
                $alun = Student::where('user_id', $user->id)->first();
                if($alun) {
                $ar['class_id'] = $alun->classe->class_id;
                }
                return response()->json($ar);
            }
                
            return response()->json([
                'msg' => 'error.',
                ], 404);
        }
        return redirect()->route('usuários.index');
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
        $id = $request->input('id');
        $usuario = User::find($id);
        $professor = Teacher::where('user_id', $id)->first();
        if(!$professor) {
            $professor = new Teacher();
        }
        if($usuario) {
            if($request->input('salvar')) {
                $usuario->name = $request->input('name');
                if($request->input('teacher')) {
                    $professor->user_id = $id;
                    $professor->type = 1;
                    $professor->created_at = Carbon::now();
                }
                try {
                    $usuario->save();
                    if($request->input('teacher')) {
                        //
                        $professor->save();
                        $aluno = Student::find($id);
                        if($aluno) {
                            $aluno->delete();
                        }
                    } else {
                        $professor->delete();
                        $aluno = Student::find($id);
                        if(!$aluno) {
                            $aluno->user_id = $id;
                            $aluno->save();
                        }
                    }
                } catch (\Illuminate\Database\QueryException $e) {
                    Log::error('Erro ao editar usuário no banco de dados.');
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
            if($request->input('deletar')) {
                if($usuario->teacher->type > 3) {
                    abort(503);
                }
                $usuario->delete();
                return $this->index(false, true);
            }
        } else {
            return $this->index();
        }
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
