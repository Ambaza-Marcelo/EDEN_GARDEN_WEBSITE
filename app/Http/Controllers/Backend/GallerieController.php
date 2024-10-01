<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Gallerie;

class GallerieController extends Controller
{
    //
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
        if (is_null($this->user) || !$this->user->can('gallerie.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        $galleries = DB::table('galleries')->orderBy('created_at','desc')->get();
        return view('backend.pages.gallerie.index',compact('galleries'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('gallerie.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        return view('backend.pages.gallerie.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072',

        ]);

        $storagepath = $request->file('image')->store('public/gallerie');
        $fileName = basename($storagepath);

        
        $picture['image'] = $fileName;

        $data = new Gallerie();
        $data->image = $picture['image'];
        $data->save();
        session()->flash('success', 'Image a été créé!!');

        return redirect()->route('admin.galleries.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallerie  $gallerie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (is_null($this->user) || !$this->user->can('gallerie.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        $gallerie = Gallerie::findOrFail($id);
        return view('backend.pages.gallerie.edit', compact('gallerie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallerie  $gallerie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072',

        ]);

        $gallerie = Gallerie::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/gallerie".$gallerie->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/galleries');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $gallerie->fill($data);
        $gallerie->save();
        session()->flash('success', 'Gallerie a été modifié!!');
        return redirect()->route('admin.galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallerie  $gallerie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('gallerie.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 
        //
        $gallerie = Gallerie::findOrFail($id);
        $file_path = "public/gallerie/".$gallerie->image;
            Storage::delete($file_path);
        $gallerie->delete();
        session()->flash('success', 'Image a été supprimé!!');
        return redirect()->back();
    }
}
