<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\CategoryRoom;

class CategoryRoomController extends Controller
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
        $categories = DB::table('category_rooms')->orderBy('created_at','desc')->get();
        return view('backend.pages.categoryRoom.index',compact('categories'));
    }
    public function create()
    {
        return view('backend.pages.categoryRoom.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $categoryRoom = new CategoryRoom();
        $categoryRoom->name = $request->name;
        $categoryRoom->save();

        session()->flash('success', 'Categorie est créé !!');

        return redirect()->route('admin.category_rooms.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryRoom  $categoryRoom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categoryRoom = CategoryRoom::findOrFail($id);
        return view('backend.pages.categoryRoom.edit', compact('categoryRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryRoom  $categoryRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $categoryRoom = CategoryRoom::findOrFail($id);

        $categoryRoom->name = $request->name;
        $categoryRoom->save();
        session()->flash('success', 'Categorie est modifié !!');
        return redirect()->route('admin.category_rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryRoom  $categoryRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoryRoom = CategoryRoom::findOrFail($id);
        $categoryRoom->delete();
        session()->flash('success', 'Categorie est supprimé !!');
        return redirect()->back();
    }
}
