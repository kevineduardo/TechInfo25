<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\Categorie;
use App\CategoryPageAttr;

class PortalPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ss = false, $msg = 0)
    {
        $pgs = Page::with('category')->get();
        $cats = Categorie::paginate(15);
        return view('portal.paginas')->with(['paginas' => $pgs, 'cats' => $cats, 'success' => $ss, 'msg' => $msg,]);
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
        if((bool)$request->newcat) {
            // tem q fazer as validações aqui dps
            return $this->handlecat($request);
        }
        if((bool)$request->editcat) {
            return $this->handlecat($request);
        }

        if((bool)$request->newpg) {
            return $this->handlepg($request);
        }
        if((bool)$request->editpg) {
            return $this->handlepg($request);
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

    public function cat(Request $request, $id) {
        if($request->ajax()) {
            $cat = Categorie::find($id);
            if(!$cat) {
                abort(404);
            }
            return response()->json($cat->toArray());
        }
        return redirect()->route('portal_inicio');
    }

    public function handlecat(Request $request) {
        if((bool)$request->newcat) {
            $cat = new Categorie();
            $cat->name = $request->name;
            $cat->icon = $request->icon;
            $cat->save();
            return $this->index(true);
        }
        if((bool)$request->editcat) {
            $id = (int)$request->selected;
            $cat = Categorie::find($id);
            if(!$cat) {
                return redirect()->route('portal_inicio');
            }
            if($request->deletar) {
                $cat->delete();
                return $this->index(false,2);
            }
            $cat->name = $request->name;
            $cat->icon = $request->icon;
            $cat->save();
            return $this->index(false,1);
        }
    }

    public function handlepg(Request $request) {
        if((bool)$request->newpg) {
            $pg = new Page();
            $pg->title = $request->title;
            $pg->text = $request->text;
            $pg->navbar_icon = $request->navbar_icon;
            if($request->custom_url != "") {
                $pg->type = 2;
                $pg->custom_url = $request->custom_url;
            } else {
                $pg->type = 1;
                $pg->text = $request->text;
            }
            $pg->save();
            $cpg = new CategoryPageAttr();
            $cpg->page_id = $pg->id;
            $cpg->category_id = $request->category_id;
            $cpg->save();
            return $this->index(false,3);
        }
        if((bool)$request->editpg) {
            $id = $request->selected;
            $pg = Page::find($id);
            if(!$pg) {
                return redirect()->route('portal_inicio');
            }
            if((bool)$request->deletar) {
                $pg->delete();
                return $this->index(false,5);
            }
            $pg->title = $request->title;
            $pg->text = $request->text;
            $pg->navbar_icon = $request->navbar_icon;
            if($request->custom_url != "") {
                $pg->type = 2;
                $pg->custom_url = $request->custom_url;
            } else {
                $pg->type = 1;
                $pg->text = $request->text;
            }
            $pg->save();
            return $this->index(false,4);
        }
    }
}
