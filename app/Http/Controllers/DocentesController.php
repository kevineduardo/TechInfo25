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
    	if ( !$teacher ) { return redirect()->route('docentes'); }
    	return view('docentes',[
    		'docente' => $teacher
    	]);
    }
}
