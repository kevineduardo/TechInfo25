<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Picture;

class PortalPicturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyteacher:1');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ss = false, $msg = 0)
    {
        $fotos = Picture::where('type', 0)->paginate(28);
        return view('portal.fotos')->with(['pics' => $fotos, 'success' => $ss, 'msg' => $msg,]);
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
        if((bool)$request->newpicture) {
            $this->validate($request, [
                'title' => 'required|max:30|min:5',
                'description' => 'required|min:10|max:400',
                'arquivo' => 'required|image|max:5000',
            ]);
            return $this->handlepicture($request);
        }
        if((bool)$request->editpicture) {
            if((bool)$request->deletar) {
                return $this->handlepicture($request);
            }
            $this->validate($request, [
                'title' => 'required|max:30|min:5',
                'description' => 'required|min:10|max:400',
                'arquivo' => 'required|image|max:5000',
            ]);
            return $this->handlepicture($request);
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

    public function foto(Request $request, $id) {
        if($request->ajax()) {
            $foto = Picture::find($id);
            if(!$foto) {
                abort(404);
            }
            return response()->json($foto->toArray());
        }
        return redirect()->route('portal_inicio');
    }

    public function handlepicture(Request $request) {
        if((bool)$request->newpicture) {
            $foto = new Picture();
            $foto->title = $request->title;
            $foto->description = $request->description;
            $arq = $request->file('arquivo')->store('public');
            $arq = str_replace('public', 'storage', $arq);
            $foto->path = $arq;
            $foto->save();
            return $this->index(true);
        }
        if((bool)$request->editpicture) {
            $id = (int)$request->selected;
            $foto = Picture::find($id);
            if(!$foto) {
                return redirect()->route('portal_inicio');
            }
            if((bool)$request->deletar) {
                $path = $foto->path;
                $path = str_replace('storage', 'public', $path);
                Storage::delete($path);
                $foto->delete();
                return $this->index(false,2);
            }
            $foto->title = $request->title;
            $foto->description = $request->description;
            $path = $foto->path;
            $path = str_replace('storage', 'public', $path);
            Storage::delete($path);
            $arq = $request->file('arquivo')->store('public');
            $arq = str_replace('public', 'storage', $arq);
            $foto->path = $arq;
            $foto->save();
            return $this->index(false,1);
        }
    }
}
