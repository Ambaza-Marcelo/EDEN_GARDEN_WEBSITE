<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Testimonial;
use \App\Models\Position;
use Validator;

class TestimonialController extends Controller
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
        if (is_null($this->user) || !$this->user->can('testimonial.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }


        $testimonials = DB::table('testimonials')->orderBy('created_at','desc')->get();
        return view('backend.pages.testimonial.index',compact('testimonials'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('testimonial.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        return view('backend.pages.testimonial.create');
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072'
            );

            $error = Validator::make($request->all(),$rules);

            if($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all(),
                ]);
            }

        $name = $request->name;
        $position = $request->position;
        $description = $request->description;

        $storagepath = $request->file('image')->store('public/testimonial');
        $fileName = basename($storagepath);

        $picture['image'] = $fileName;

        $data = new Testimonial();
        $data->name = $name;
        $data->position = $position;
        $data->description = $description;
        $data->image = $picture['image'];
        $data->save();
        session()->flash('success', 'Commentaire a été créé!!');

        return redirect()->route('admin.testimonials.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('testimonial.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.pages.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'position' => 'required',

        ]);

        $testimonial = Testimonial::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/testimonial".$testimonial->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/testimonial');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $testimonial->fill($data);
        $testimonial->save();
        session()->flash('success', 'Commentaire a été modifié!!');
        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('testimonial.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $testimonial = Testimonial::findOrFail($id);
        $file_path = "public/testimonial/".$testimonial->image;
            Storage::delete($file_path);
        $testimonial->delete();
        session()->flash('success', 'Commentaire a été supprimé!!');
        return redirect()->back();
    }
}
