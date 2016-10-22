<?php

namespace App\Http\Controllers;

use Illuminate\Http\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Teacher;
use App\User;
use App\Http\Requests;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('docentes',[ 
           'professores' => Teacher::where('type', 1)->with('user')->get(),
           'coordenadores' => Teacher::where('type', 2)->with('user')->get(),
        ]);
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
        $teacher = Teacher::with('user')->where('user_id',$id)->first();
        if ( !$teacher ) { return [ 'ok' => 0 ]; }
        return Response::json([
            'ok' => 1,
            'docente' => [
                'name'         => $teacher->user->name,
                'bio'          => nl2br($teacher->bio),
                'academic_bg'  => nl2br($teacher->academic_bg),
                'tipo'         => ( $teacher->type == 1 ) ? 'professor(a)' : 'coordenador(a)',
                'tipo_id'      => $teacher->type,
                'img'          => 'http://placehold.it/200x200',
            ]
        ]);
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
