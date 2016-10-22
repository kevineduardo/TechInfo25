<?php

namespace App\Http\Controllers;

use Illuminate\Http\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Teacher;
use App\User;
use App\Http\Requests;

class DocentesController extends Controller
{
	/*
	 * @returns View
	 */
    protected function index()
    {
    	return view('docentes',[ 
    		'docentes' => Teacher::with('user')->paginate(10)
    	]);
    }
    protected function bio( $id ) {
    	$teacher = Teacher::with('user')->where('user_id',$id)->first();
    	if ( !$teacher ) { return [ 'ok' => 0 ]; }
    	return [
            'ok' => 1,
    		'docente' => [
                'name'         => $teacher->user->name,
                'bio'          => $teacher->bio,
                'academic_bg'  => $teacher->academic_bg,
                'tipo'         => ( $teacher->type == 1 ) ? 'professor(a)' : 'coordenador(a)',
                'tipo_id'      => $teacher->type,
            ]
    	];
    }
}
