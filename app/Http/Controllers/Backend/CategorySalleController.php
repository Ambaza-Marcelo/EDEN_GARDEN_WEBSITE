<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\CategorySalle;

class CategorySalleController extends Controller
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
        $categories = DB::table('category_salles')->orderBy('created_at','desc')->get();
        return view('backend.pages.categorySalle.index',compact('categories'));
    }
    public function create()
    {
        return view('backend.pages.categorySalle.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $categorySalle = new CategorySalle();
        $categorySalle->name = $request->name;
        $categorySalle->save();

        session()->flash('success', 'Categorie est créé !!');

        return redirect()->route('admin.category_salles.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategorySalle  $categorySalle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categorySalle = CategorySalle::findOrFail($id);
        return view('backend.pages.categorySalle.edit', compact('categorySalle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategorySalle  $categorySalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $categorySalle = CategorySalle::findOrFail($id);

        $categorySalle->name = $request->name;
        $categorySalle->save();
        session()->flash('success', 'Categorie est modifié !!');
        return redirect()->route('admin.category_salles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategorySalle  $categorySalle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categorySalle = CategorySalle::findOrFail($id);
        $categorySalle->delete();
        session()->flash('success', 'Categorie est supprimé !!');
        return redirect()->back();
    }
}
