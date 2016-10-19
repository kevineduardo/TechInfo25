<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

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
        $news = News::take(3)->orderBy('published_at', 'desc')->get();
        return view('portal.inicio', ['news' => $news,]);
    }
}
