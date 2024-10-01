<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Restauration;
use \App\Models\CategoryRestauration;
use Validator;

class RestaurationController extends Controller
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
        if (is_null($this->user) || !$this->user->can('restauration.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        $restaurations = Restauration::with('categoryRestauration')->orderBy('created_at','desc')->get();
        //$restaurations = DB::table('restaurations')->orderBy('created_at','desc')->get();
        return view('backend.pages.restauration.index',compact('restaurations'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('restauration.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $categoryRestaurations = CategoryRestauration::all();
        return view('backend.pages.restauration.create',compact('categoryRestaurations'));
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'title' => 'required',
            'subtitle.*' => 'required',
            'category_restauration_id' => 'required',
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
        $category_restauration_id = $request->category_restauration_id;
        $old_price = $request->old_price;
        $price = $request->price;
        $description = $request->description;
            

        $storagepath = $request->file('image')->store('public/restauration');
        $fileName = basename($storagepath);

        $restauration['image'] = $fileName;

        for( $count = 0; $count < count($subtitle); $count++ )
        {
          $restauration = array(
            'subtitle'=> $subtitle[$count],
            'title'=>$title,
            'category_restauration_id'=>$category_restauration_id,
            'old_price'=>$old_price,
            'price'=>$price,
            'description'=>$description,
            'image'=>$restauration['image']
            );
        }

        $data[] = $restauration;

        Restauration::insert($data);
        session()->flash('success', 'Restauration a été créé!!');

        return redirect()->route('admin.restaurations.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restauration  $restauration
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('restauration.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $categoryRestaurations = CategoryRestauration::all();
        $restauration = Restauration::findOrFail($id);
        $datas = Restauration::where('id',$id)->get();
        return view('backend.pages.restauration.edit', compact('restauration','categoryRestaurations','datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restauration  $restauration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'category_restauration_id' => 'required',
            'old_price' => 'required',
            'price' => 'required',
            'description' => 'required'

        ]);

        $restauration = Restauration::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/restauration".$restauration->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/restaurations');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $restauration->fill($data);
        $restauration->save();
        session()->flash('success', 'Restauration a été modifié!!');
        return redirect()->route('admin.restaurations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restauration  $restauration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('restauration.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $restauration = Restauration::findOrFail($id);
        $file_path = "public/restauration/".$restauration->image;
            Storage::delete($file_path);
        $restauration->delete();
        session()->flash('success', 'Restauration a été supprimé!!');
        return redirect()->back();
    }
}
