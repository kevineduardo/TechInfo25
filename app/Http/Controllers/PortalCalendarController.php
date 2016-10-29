<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Calendar;
use Carbon\Carbon;

class PortalCalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyteacher');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Calendar::orderBy('date',true)->paginate(10);
        return view( 'portal.calendario', [ 'datas' => $datas ] );
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
        if ( !request()->ajax() ) { return redirect()->route('calendário.index'); }
        $data = Calendar::with('user')->where('id', $id)->first();
        return response()->json($data);
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
    public function update(Request $request)
    {   
        $id = $request->input('id');
        $date = Calendar::with('user')->where('id', $id)->first();
        if( $request->input('salvar') ) {
            $date->name = $request->input('name');
            $date->description = $request->input('desc');
            $date->date = Carbon::parse($request->input('date'));
            $date->save();
        }
        if( $request->input('deletar') ) {
            $date->delete();
        }
        return redirect()->route( 'calendário.index' );
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
