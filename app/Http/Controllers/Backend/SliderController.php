<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Slider;

class SliderController extends Controller
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
        if (is_null($this->user) || !$this->user->can('slider.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

    	$sliders = DB::table('sliders')->orderBy('created_at','desc')->get();
    	return view('backend.pages.sliders.index',compact('sliders'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('slider.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

    	return view('backend.pages.sliders.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072',

        ]);

        $storagepath = $request->file('image')->store('public/sliders');
        $fileName = basename($storagepath);

        $data = $request->all();
        $data['image'] = $fileName;

        Slider::create($data);
        session()->flash('success', 'Slider a été créé!!');

        return redirect()->route('admin.sliders.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('slider.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $slider = Slider::findOrFail($id);
        return view('backend.pages.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $slider = Slider::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/slider".$slider->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/sliders');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $slider->fill($data);
        $slider->save();
        session()->flash('success', 'Slider a été modifié!!');
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('slider.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $slider = Slider::findOrFail($id);
        $file_path = "public/slider/".$slider->image;
            Storage::delete($file_path);
        $slider->delete();
        session()->flash('success', 'Slider a été supprimé!!');
        return redirect()->back();
    }
}
