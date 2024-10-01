<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Certification;

class CertificationController extends Controller
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
       $certifications = DB::table('certifications')->orderBy('created_at','desc')->get();
        return view('backend.pages.certification.index',compact('certifications'));
    }

    public function create()
    {
        return view('backend.pages.certification.create');
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
            

        $storagepath = $request->file('image')->store('public/certification');
        $fileName = basename($storagepath);

        $certification['image'] = $fileName;

        for( $count = 0; $count < count($subtitle); $count++ )
        {
          $certification = array(
            'subtitle'=> $subtitle[$count],
            'title'=>$title,
            'description'=>$description,
            'image'=>$certification['image']
            );
        }

        $data[] = $certification;

        Certification::insert($data);
        session()->flash('success', 'Certification a été créé!!');

        return redirect()->route('admin.certifications.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $certification = Certification::findOrFail($id);
        $datas = Certification::where('id',$id)->get();
        return view('backend.pages.certification.edit', compact('certification','datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required'

        ]);

        $certification = Certification::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/certification".$certification->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/certification');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $certification->fill($data);
        $certification->save();
        session()->flash('success', 'Certification a été modifié!!');
        return redirect()->route('admin.certifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $certification = Certification::findOrFail($id);
        $file_path = "public/certification/".$certification->image;
            Storage::delete($file_path);
        $certification->delete();
        session()->flash('success', 'Certification a été supprimé!!');
        return redirect()->back();
    }
}
