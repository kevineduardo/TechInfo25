<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Http\Requests;
use App\Homework;
use App\TeacherAttr;
use App\Teacher;
use Auth;

class PortalHomeworksController extends Controller
{
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
            $trabalhos = Homework::paginate(15);
            $materias = TeacherAttr::distinct()->select('subject_id')->where('teacher_id', $professor->id)->groupBy('subject_id')->get();
            $turmas = TeacherAttr::distinct()->select('class_id')->where('teacher_id', $professor->id)->get();
        } else {
            // TEM Q ARRUMAR AQUI
            $trabalhos = Homework::where('class_id', $user->student->classe->class_id)->paginate(15);
            $materias = null;
            $turmas = null;
        }
        return view('portal.trabalhos')->with(['professor' => $professor, 'trabalhos' => $trabalhos, 'subjects' => $materias, 'classes' => $turmas, 'success' => $ss, 'msg' => $msg,]);
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
        if((bool)$request->newhomework) {
            $this->validate($request, [
                'teacher_id' => 'required|numeric',
                'subject_id' => 'required|numeric',
                'class_id' => 'required|numeric',
                'title' => 'required|max:30|string',
                'arquivo' => 'required|file|mimes:docx,pptx,pdf,txt,doc',
                'deadline' => 'required|date_format:"d/m/Y H:i"',

            ]);
            return $this->handlehomework($request);
        }
        if((bool)$request->edithomework) {
            $this->validate($request, [
                'teacher_id' => 'required|numeric',
                'subject_id' => 'required|numeric',
                'class_id' => 'required|numeric',
                'title' => 'required|max:30|string',
                'arquivo' => 'file|mimes:docx,pptx,pdf,txt,doc',
                'deadline' => 'required|date_format:"d/m/Y H:i"',

            ]);
            return $this->handlehomework($request);
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

    public function trabalho(Request $request, $id) {
        if($request->ajax()) {
            $trabalho = Homework::find($id);
            if(!$trabalho) {
                abort(404);
            }
            $ar = $trabalho->toArray();
            $ar['deadline'] = $trabalho->deadline->format('d/m/Y H:i');
            return response()->json($ar);
        }
        return redirect()->route('portal_inicio');
    }

    public function handlehomework(Request $request) {
        $dataf = Carbon::createFromFormat('d/m/Y H:i', $request->data);
        $data = $dataf->format('Y-m-d H:i:s');
        if((bool)$request->newhomework) {
            $trab = new Homework();
            $trab->teacher_id = Auth::user()->teacher->id;
            $trab->subject_id = $request->subject_id;
            $trab->class_id = $request->class_id;
            $trab->title = $request->title;
            $arq = $request->file('arquivo')->store('public');
            $arq = str_replace('public', 'storage', $arq);
            $trab->path = $arq;
            $trab->deadline = $data;
            $trab->save();
            return $this->index(true);
        }
        if((bool)$request->edithomework) {
            $id = (int)$request->selected;
            $trab = Homework::find($id);
            if(!$trab) {
                return redirect()->route('portal_inicio');
            }
            if($request->deletar) {
                $path = $trab->path;
                $path = str_replace('storage', 'public', $path);
                Storage::delete($path);
                $trab->delete();
                return $this->index(false,2);
            }
            $trab->teacher_id = Auth::user()->teacher->id;
            $trab->subject_id = $request->subject_id;
            $trab->class_id = $request->class_id;
            $trab->title = $request->title;
            $path = $trab->path;
            $path = str_replace('storage', 'public', $path);
            Storage::delete($path);
            if($request->file('arquivo')) {
                $arq = $request->file('arquivo')->store('public');
                $arq = str_replace('public', 'storage', $arq);
                $trab->path = $arq;
            }
            $trab->deadline = $data;
            $trab->save();
            return $this->index(false,1);
        }
    }
}
