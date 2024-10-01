<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Event;
use Validator;

class EventController extends Controller
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
         if (is_null($this->user) || !$this->user->can('evenement.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        $events = DB::table('events')->orderBy('created_at','desc')->get();
        return view('backend.pages.event.index',compact('events'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('evenement.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 

        return view('backend.pages.event.create');
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'title' => 'required',
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
        $old_price = $request->old_price;
        $price = $request->price;
        $description = $request->description;
            

        $storagepath = $request->file('image')->store('public/events');
        $fileName = basename($storagepath);

        $event['image'] = $fileName;

        $data = new Event();
        $data->title = $title;
        $data->old_price = $old_price;
        $data->price = $price;
        $data->description = $description;
        $data->image = $event['image'];
        $data->save();
        session()->flash('success', 'Evenement a été créé!!');

        return redirect()->route('admin.events.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('evenement.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 
        //
        $event = Event::findOrFail($id);
        return view('backend.pages.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'old_price' => 'required',
            'price' => 'required',
            'description' => 'required'

        ]);

        $event = Event::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/events".$event->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/events');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $event->fill($data);
        $event->save();
        session()->flash('success', 'Event a été modifié!!');
        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('evenement.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        } 
        //
        $event = Event::findOrFail($id);
        $file_path = "public/events/".$event->image;
            Storage::delete($file_path);
        $event->delete();
        session()->flash('success', 'Event a été supprimé!!');
        return redirect()->back();
    }
}
