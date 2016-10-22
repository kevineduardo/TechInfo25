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
	/*
	 * @returns View
	 */
    protected function index()
    {
    	return view('docentes',[ 
    	   'professores' => Teacher::where('type', 1)->with('user')->get(),
           'coordenadores' => Teacher::where('type', 2)->with('user')->get(),
    	]);
    }
    protected function bio( $id ) {
    	$teacher = Teacher::with('user')->where('user_id',$id)->first();
    	if ( !$teacher ) { return [ 'ok' => 0 ]; }
    	return [
            'ok' => 1,
    		'docente' => [
                'name'         => $teacher->user->name,
                'bio'          => nl2br($teacher->bio),
                'academic_bg'  => nl2br($teacher->academic_bg),
                'tipo'         => ( $teacher->type == 1 ) ? 'professor(a)' : 'coordenador(a)',
                'tipo_id'      => $teacher->type,
                'img'          => 'http://placehold.it/200x200',
            ]
    	];
    }
}
