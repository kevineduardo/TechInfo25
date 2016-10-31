<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Calendar;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( request()->ajax() ) {
            $start = $request->input('start');
            $end = $request->input('end');

            $datas = [];
            foreach( Calendar::whereDate('date','>=',$start)->
                               whereDate('date','<=',$end)->get() as $data ) {
                $datas[] = [
                    'title' => $data->name,
                    'start' => $data->date->format('Y-m-d'),
                    'url'   => route( 'calendário.show', $data->id )
                ];
            }
            return response()->json($datas);
        }
        return view('calendario');
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( !request()->ajax() ) { return redirect()->route( 'calendário' ); }
        $data = Calendar::where('id',$id)->first();
        if ( !$data ) { abort( 404 ); }
        return response()->json( $data );
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
