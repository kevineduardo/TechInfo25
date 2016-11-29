<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Calendar;
use Carbon\Carbon;
use Auth;

class PortalCalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyteacher:2');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ss = false, $msg = 0)
    {
        $eventos = Calendar::latest()->paginate(15);
        return view('portal.eventos')->with(['eventos' => $eventos, 'success' => $ss, 'msg' => $msg]);
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
        if((bool)$request->newevent) {
            $this->validate($request, [
                'name' => 'required|string|min:5|max:100',
                'description' => 'required|string|min:10|max:300',
                'place' => 'required|string|min:3|max:100',
                'data' => 'required|date_format:"d/m/Y H:i"',
            ]);
            return $this->handleevent($request);
        }
        if((bool)$request->editevent) {
            if((bool)$request->deletar) {
                return $this->handleevent($request);
            }
            $this->validate($request, [
                'name' => 'required|string|min:5|max:100',
                'description' => 'required|string|min:10|max:300',
                'place' => 'required|string|min:3|max:100',
                'data' => 'required|date_format:"d/m/Y H:i"',
            ]);
            return $this->handleevent($request);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function evento(Request $request, $id) {
        if($request->ajax()) {
            $evento = Calendar::find($id);
            if(!$evento) {
                abort(404);
            }
            $ar = $evento->toArray();
            $ar['date'] = $evento->date->format('d/m/Y H:i');
            return response()->json($ar);
        }
        return redirect()->route('portal_inicio');
    }

    public function handleevent(Request $request) {
        $dataf = Carbon::createFromFormat('d/m/Y H:i', $request->data);
        $data = $dataf->format('Y-m-d H:i:s');
        if((bool)$request->newevent) {
            $evento = new Calendar();
            $evento->name = $request->name;
            $evento->description = $request->description;
            $evento->place = $request->place;
            $evento->date = $data;
            $evento->author_id = Auth::user()->id;
            $evento->save();
            return $this->index(true);
        }
        if((bool)$request->editevent) {
            $id = (int)$request->selected;
            $evento = Calendar::find($id);
            if(!$evento) {
                return redirect()->route('portal_inicio');
            }
            if((bool)$request->deletar) {
                $evento->delete();
                return $this->index(false, 2);
            }
            $evento->name = $request->name;
            $evento->description = $request->description;
            $evento->place = $request->place;
            $evento->date = $data;
            $evento->author_id = Auth::user()->id;
            $evento->save();
            return $this->index(false,1);
        }
    }
}
