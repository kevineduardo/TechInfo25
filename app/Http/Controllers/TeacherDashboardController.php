<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Teacher;
use App\User;
use App\Subject;
use App\Classe;
use App\TeacherAttr;

class TeacherDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyteacher:1');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ss = false, $msg = 0)
    {
        $usuario = Auth::user();
        $turmas = TeacherAttr::where('teacher_id', $usuario->teacher->id)->paginate(15);
        $subs = Subject::all();
        $classes = Classe::all();
        $bio = $usuario->teacher->bio;
        $abg = $usuario->teacher->academic_bg;
        return view('portal.professor')->with(['success' => $ss, 'turmas' => $turmas, 'classes' => $classes, 'subjects' => $subs, 'bio' => $bio, 'abg' => $abg, 'msg' => $msg,]);
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
        if((bool)$request->info) {
            $this->validate($request, [
                'bio' => 'required|max:400',
                'abg' => 'required|alpha_num',
            ]);
            return $this->handleinfo($request);
        }
        if((bool)$request->newclass) {
            $this->validate($request, [
                'class_id' => 'required|numeric',
                'subject_id' => 'required|numeric',
            ]);
            return $this->handleclass($request);
        }
        if((bool)$request->editclass) {
            $this->validate($request, [
                'class_id' => 'required|numeric',
                'subject_id' => 'required|numeric',
            ]);
            return $this->handleclass($request);
        }
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

    public function turma(Request $request, $id) {
        if($request->ajax()) {
            $turma = TeacherAttr::find($id);
            if(!$turma) {
                abort(404);
            }
            return response()->json($turma->toArray());
        }
        return redirect()->route('portal_inicio');
    }

    public function handleinfo(Request $request) {
        $prof = Auth::user()->teacher;
        $prof->bio = $request->bio;
        $prof->academic_bg = $request->abg;
        $prof->save();
        return $this->index(true);
    }

    public function handleclass(Request $request) {
        if((bool)$request->newclass) {
            $tm = new TeacherAttr();
            $tm->teacher_id = Auth::user()->teacher->id;
            $tm->subject_id = $request->subject_id;
            $tm->class_id = $request->class_id;
            $tm->save();
            return $this->index(false,1);
        }
        if((bool)$request->editclass) {
            $id = (int) $request->selected;
            $tm = TeacherAttr::find($id);
            if((bool) $request->deletar) {
                $tm->delete();
                return $this->index(false,3);
            }
            $tm->teacher_id = Auth::user()->teacher->id;
            $tm->subject_id = $request->subject_id;
            $tm->class_id = $request->class_id;
            $tm->save();
            return $this->index(false,2);
        }
    }
}
