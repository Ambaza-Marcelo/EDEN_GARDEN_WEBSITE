<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Salle;
use \App\Models\CategorySalle;
use Validator;

class SalleController extends Controller
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
        if (is_null($this->user) || !$this->user->can('salle.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $salles = Salle::with('categorySalle')->orderBy('created_at','desc')->get();
        //$salles = DB::table('salles')->orderBy('created_at','desc')->get();
        return view('backend.pages.salle.index',compact('salles'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('salle.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }


        $categorySalles = CategorySalle::all();
        return view('backend.pages.salle.create',compact('categorySalles'));
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'title' => 'required',
            'subtitle.*' => 'required',
            'category_salle_id' => 'required',
            'old_price' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072'
            );

            $error = Validator::make($request->all(),$rules);

            if($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all(),
                ]);
            }

        $title = $request->title;
        $subtitle = $request->subtitle;
        $category_salle_id = $request->category_salle_id;
        $old_price = $request->old_price;
        $price = $request->price;
        $description = $request->description;
            

        $storagepath = $request->file('image')->store('public/salle');
        $fileName = basename($storagepath);

        $salle['image'] = $fileName;

        for( $count = 0; $count < count($subtitle); $count++ )
        {
          $salle = array(
            'subtitle'=> $subtitle[$count],
            'title'=>$title,
            'category_salle_id'=>$category_salle_id,
            'old_price'=>$old_price,
            'price'=>$price,
            'description'=>$description,
            'image'=>$salle['image']
            );
        }

        $data[] = $salle;

        Salle::insert($data);
        session()->flash('success', 'Salle a été créé!!');

        return redirect()->route('admin.salles.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('salle.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $categorySalles = CategorySalle::all();
        $salle = Salle::findOrFail($id);
        $datas = Salle::where('id',$id)->get();
        return view('backend.pages.salle.edit', compact('salle','categorySalles','datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $salle = Salle::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/salle".$salle->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/salles');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $salle->fill($data);
        $salle->save();
        session()->flash('success', 'Salle a été modifié!!');
        return redirect()->route('admin.salles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('salle.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $salle = Salle::findOrFail($id);
        $file_path = "public/salle/".$salle->image;
            Storage::delete($file_path);
        $salle->delete();
        session()->flash('success', 'Salle a été supprimé!!');
        return redirect()->back();
    }
}
