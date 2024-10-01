<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Paillote;

class PailloteController extends Controller
{
    //
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('paillote.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }  

        $paillotes = DB::table('paillotes')->orderBy('created_at','desc')->get();
        return view('backend.pages.paillote.index',compact('paillotes'));
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('paillote.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        return view('backend.pages.paillote.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'ofpeople' => 'required',

        ]);

        $paillote = new Paillote();
        $paillote->name = $request->name;
        $paillote->ofpeople = $request->ofpeople;
        $paillote->save();

        session()->flash('success', 'Paillote est créé !!');

        return redirect()->route('admin.paillotes.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paillote  $paillote
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('paillote.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 
        //
        $paillote = Paillote::findOrFail($id);
        return view('backend.pages.paillote.edit', compact('paillote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paillote  $paillote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'ofpeople' => 'required'
        ]);

        $paillote = Paillote::findOrFail($id);

        $paillote->name = $request->name;
        $paillote->ofpeople = $request->ofpeople;
        $paillote->save();
        session()->flash('success', 'Paillote est modifié !!');
        return redirect()->route('admin.paillotes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paillote  $paillote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('paillote.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 
        //
        $paillote = Paillote::findOrFail($id);
        $paillote->delete();
        session()->flash('success', 'Paillote est supprimé !!');
        return redirect()->back();
    }
}
