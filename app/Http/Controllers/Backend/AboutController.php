<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\About;
use Validator;

class AboutController extends Controller
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
        if (is_null($this->user) || !$this->user->can('about.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any about !');
        }

    	$abouts = DB::table('abouts')->orderBy('created_at','desc')->get();
    	return view('backend.pages.abouts.index',compact('abouts'));
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('about.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any about !');
        }

    	return view('backend.pages.abouts.create');
    }

     public function store(Request $request)
    {
        //
        $rules = array(
            'title' => 'required',
            'subtitle.*' => 'required',
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
        $description = $request->description;
            

        $storagepath = $request->file('image')->store('public/abouts');
        $fileName = basename($storagepath);

        $about['image'] = $fileName;

        for( $count = 0; $count < count($subtitle); $count++ )
        {
          $about = array(
            'subtitle'=> $subtitle[$count],
            'title'=>$title,
            'description'=>$description,
            'image'=>$about['image']
        );
      }

        $data[] = $about;

        About::insert($data);
        session()->flash('success', 'About has been created !!');

        return redirect()->route('admin.abouts.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('about.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any about !');
        }

        //
        $about = About::findOrFail($id);
        $datas = About::where('id',$id)->get();
        return view('backend.pages.abouts.edit', compact('about','datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $about = About::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/abouts/".$about->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/abouts');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $about->fill($data);
        $about->save();

        session()->flash('success', 'About has been updated !!');

        return redirect()->route('admin.abouts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('about.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any about !');
        }

        //
        $about = About::findOrFail($id);
        $file_path = "public/abouts/".$about->image;
            Storage::delete($file_path);
        $about->delete();
        return redirect()->back();
    }
}
