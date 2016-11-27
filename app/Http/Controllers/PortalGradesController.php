<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

use App\Grade;
use App\Teacher;
use App\Student;
use App\TeacherAttr;

class PortalGradesController extends Controller
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
    public function index($ss = false, $msg = 0)
    {
        $user = Auth::user();
        $professor = Teacher::where('user_id', $user->id)->first();
        if($professor) {
            $notas = Grade::paginate(15);
            $alunos = Student::all();
            $materias = TeacherAttr::distinct()->select('subject_id')->where('teacher_id', $professor->id)->groupBy('subject_id')->get();
            $turmas = TeacherAttr::distinct()->select('class_id')->where('teacher_id', $professor->id)->get();
        } else {
            $notas = Grade::where('student_id', $user->student->id)->paginate(15);
            $alunos = null;
            $materias = null;
            $turmas = null;
        }
        return view('portal.notas')->with(['professor' => $professor, 'notas' => $notas, 'students' => $alunos, 'subjects' => $materias, 'classes' => $turmas, 'success' => $ss, 'msg' => $msg,]);
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
        if((bool)$request->newgrade) {
            $this->validate($request, [
                'student_id' => 'required|numeric',
                'subject_id' => 'required|numeric',
                'class_id' => 'required|numeric',
                'grade' => 'required|max:30|string',
            ]);
            return $this->handlegrade($request);
        }
        if((bool)$request->editgrade) {
            $this->validate($request, [
                'student_id' => 'required|numeric',
                'subject_id' => 'required|numeric',
                'class_id' => 'required|numeric',
                'grade' => 'required|max:30|string',
            ]);
            return $this->handlegrade($request);
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

    public function grade(Request $request, $id) {
        if($request->ajax()) {
            $nota = Grade::find($id);
            if(!$nota) {
                abort(404);
            }
            return response()->json($nota->toArray());
        }
        return redirect()->route('portal_inicio');
    }

    public function handlegrade(Request $request) {
        if((bool)$request->newgrade) {
            $nota = new Grade();
            $nota->teacher_id = Auth::user()->teacher->id;
            $nota->student_id = $request->student_id;
            $nota->subject_id = $request->subject_id;
            $nota->class_id = $request->class_id;
            $nota->grade = $request->grade;
            $nota->save();
            return $this->index(true);
        }
        if((bool)$request->editgrade) {
            $id = $request->selected;
            $nota = Grade::find($id);
            if(!$nota) {
                return redirect()->route('portal_inicio');
            }
            if($request->deletar) {
                $nota->delete();
                return $this->index(false,2);
            }
            $nota->teacher_id = Auth::user()->teacher->id;
            $nota->student_id = $request->student_id;
            $nota->subject_id = $request->subject_id;
            $nota->class_id = $request->class_id;
            $nota->grade = $request->grade;
            $nota->save();
            return $this->index(false,1);
        }
    }
}
