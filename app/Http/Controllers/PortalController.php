<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Teacher;

class PortalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $professor = Teacher::where('user_id', $user->id)->first();
        return view('portal.inicio', ['professor' => $professor,]);
    }
}
