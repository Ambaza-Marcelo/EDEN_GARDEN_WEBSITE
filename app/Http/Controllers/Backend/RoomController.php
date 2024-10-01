<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Room;
use \App\Models\CategoryRoom;

use Validator;

class RoomController extends Controller
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
        if (is_null($this->user) || !$this->user->can('chambre.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $rooms = Room::with('categoryRoom')->orderBy('created_at','desc')->get();
       // $rooms = DB::table('rooms')->orderBy('created_at','desc')->get();
        return view('backend.pages.room.index',compact('rooms'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('chambre.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $categoryRooms = CategoryRoom::all();
        return view('backend.pages.room.create',compact('categoryRooms'));
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'title' => 'required',
            'subtitle.*' => 'required',
            'category_room_id' => 'required',
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
        $category_room_id = $request->category_room_id;
        $old_price = $request->old_price;
        $price = $request->price;
        $description = $request->description;
            

        $storagepath = $request->file('image')->store('public/rooms');
        $fileName = basename($storagepath);

        $room['image'] = $fileName;

        for( $count = 0; $count < count($subtitle); $count++ )
        {
          $room = array(
            'subtitle'=> $subtitle[$count],
            'title'=>$title,
            'category_room_id'=>$category_room_id,
            'old_price'=>$old_price,
            'price'=>$price,
            'description'=>$description,
            'image'=>$room['image']
            );
        }

        $data[] = $room;

        Room::insert($data);
        session()->flash('success', 'Chambre/Suite a été créé!!');

        return redirect()->route('admin.rooms.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('chambre.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $categoryRooms = CategoryRoom::all();
        $room = Room::findOrFail($id);
        $datas = Room::where('id',$id)->get();
        return view('backend.pages.room.edit', compact('room','categoryRooms','datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'category_room_id' => 'required',
            'old_price' => 'required',
            'price' => 'required',
            'description' => 'required'

        ]);

        $room = Room::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/room".$room->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/rooms');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $room->fill($data);
        $room->save();
        session()->flash('success', 'Room a été modifié!!');
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('chambre.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $room = Room::findOrFail($id);
        $file_path = "public/rooms/".$room->image;
            Storage::delete($file_path);
        $room->delete();
        session()->flash('success', 'Room a été supprimé!!');
        return redirect()->back();
    }
}
