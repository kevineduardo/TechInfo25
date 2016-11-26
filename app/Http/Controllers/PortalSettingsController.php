<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classe;
use App\Setting;
use Carbon\Carbon;

class PortalSettingsController extends Controller
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
    public function index($ss = false, $st = false, $et = false, $dt = false)
    {
        $turmas = Classe::paginate(15);
        return view('portal.config', ['turmas' => $turmas, 'success' => $ss, 'st' => $st, 'et' => $et, 'dt' => $dt,]);
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
        if($request->settings) {
            $this->validate($request, [
                'site_name' => 'required|max:20|min:3',
                //'maintenance' => 'required|boolean',
                'facebook_page_url' => 'required|max:255',
                'portal_activated' => 'required|boolean',
                'footer' => 'required|max:255|min:10',
            ]);
            return $this->handleconfig($request);
        }
        if($request->newclass) {
            $this->validate($request, [
                'number' => 'required|max:999|min:100|numeric',
                'variant' => 'alpha',
            ]);
            return $this->handleturma($request);
        }
        if($request->editclass) {
            $this->validate($request, [
                'number' => 'required|max:999|min:100|numeric',
                'variant' => 'alpha',
            ]);
            return $this->handleturma($request);
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

    public function turma(Request $request, $id) {
        if($request->ajax()) {
            $turma = Classe::find($id);
            if(!$turma) {
                abort(404);
            }
            return response()->json($turma->toArray());
        }
        return redirect()->route('portal_inicio');
    }

    public function handleconfig(Request $request) {
        $nome = Setting::where('name', 'site_name')->first();
        $nome->value = $request->site_name;
        $nome->save();
        //$mnt = Setting::where('name','maintenance')->first();
        //$mnt->value = (bool)$request->maintenance;
        //$mnt->save();
        $fb = Setting::where('name', 'facebook_page_url')->first();
        $fb->value = $request->facebook_page_url;
        $fb->save();
        $pa = Setting::where('name', 'portal_activated')->first();
        $pa->value = (bool)$request->portal_activated;
        $pa->save();
        $footer = Setting::where('name', 'footer')->first();
        $footer->value = $request->footer;
        $footer->save();
        return $this->index(true);
    }

    public function handleturma(Request $request) {
        if((bool)$request->newclass) {
            $novaturma = new Classe();
            $novaturma->fill($request->all());
            $novaturma->inityear = Carbon::now();
            $novaturma->save();
            return $this->index(false,true,false, false);
        }
        if((bool)$request->editclass) {
            $id = (int)$request->selected;
            $turma = Classe::find($id);
            if($request->deletar) {
                $turma->delete();
                return $this->index(false,false,false,true);
            }
            $turma->fill($request->all());
            $turma->save();
            return $this->index(false,false,true,false);
        }
        return redirect()->route('configurações.index');
    }
}
