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
    		'title' => trans("messages.layout.docente"),
    		'docentes' => Teacher::with('user')->paginate(2)
    	]);
    }
}
