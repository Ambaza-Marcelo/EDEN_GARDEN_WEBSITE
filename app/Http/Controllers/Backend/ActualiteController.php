<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Actualite;
use \App\Models\Category;
use \App\Models\Booking;

use Mail;
use App\Mail\ActualiteMail;

class ActualiteController extends Controller
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
        if (is_null($this->user) || !$this->user->can('actualite.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any post !');
        }


    	$actualites = DB::table('actualites')->orderBy('created_at','desc')->get();
    	return view('backend.pages.actualites.index',compact('actualites'));
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('actualite.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any post !');
        }


        $categories = Category::all();
    	return view('backend.pages.actualites.create',compact('categories'));
    }

     public function store(Request $request)
    {
        //
        $request->validate([
        	'date' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072',

        ]);

        $storagepath = $request->file('image')->store('public/actualites');
        $fileName = basename($storagepath);

        $data = $request->all();
        $data['image'] = $fileName;

        Actualite::create($data);
        
        $customers = Booking::all();
        $actualite = Actualite::orderBy('created_at','desc')->first();

        $url = 'http://10.10.100.7/publications/actualite/show/'.$actualite->id;
        
  
        foreach ($customers as $key => $customer) {
            Mail::to($customer->email)->send(new ActualiteMail($customer,$actualite,$url));
        }


        session()->flash('success', 'Actualite a été créé!!');

        return redirect()->route('admin.actualites.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (is_null($this->user) || !$this->user->can('actualite.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any post !');
        }


        $actualite = Actualite::findOrFail($id);
        $categories = Category::all();
        return view('backend.pages.actualites.edit', compact('actualite','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
        	'date' => 'required',
            'title' => 'required',
            'description' => 'required',

        ]);

        $actualite = Actualite::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/actualites".$actualite->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/actualites');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $actualite->fill($data);
        $actualite->save();
        session()->flash('success', 'Actualite a été modifié!!');
        return redirect()->route('admin.actualites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actualite  $actualite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (is_null($this->user) || !$this->user->can('actualite.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any post !');
        }


        $actualite = Actualite::findOrFail($id);
        $file_path = "public/actualites/".$actualite->image;
            Storage::delete($file_path);
        $actualite->delete();
        session()->flash('success', 'Actualite a été supprimé!!');
        return redirect()->back();
    }
}
