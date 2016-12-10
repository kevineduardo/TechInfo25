<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nts = Cache::tags('notícias')->get('notícias');
        if ($nts != null) {
            $nts = Cache::tags('rnotícias')->get('rnotícias');
            return view('noticia', ['nt' => $nt, 'nts' => $nts,]);
        } 
        $nts = News::where('published', true)->orderBy('published_at', 'desc')->paginate(14);
        if(!$nts) { return redirect()->route('notícias'); }
        return view('noticia', ['nts' => $nts,]);
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
        $nts = Cache::tags('notícias')->get('notícias');
        if ($nts != null) {
            $nt = $nts->find($id);
            if(!$nt) { return redirect()->route('noticias'); }
            $nts = Cache::tags('rnotícias')->get('rnotícias');
            return view('noticia', ['nt' => $nt, 'nts' => $nts,]);
        } 
        $nt = News::where('published', true)->find($id);
        $nts = News::where('published', true)->orderBy('published_at', 'desc')->take(8)->get();
        if(!$nt) { return redirect()->route('noticias'); }
        return view('noticia', ['nt' => $nt, 'nts' => $nts,]);
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
