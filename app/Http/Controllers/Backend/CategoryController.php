<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Category;

class CategoryController extends Controller
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
        $categories = DB::table('categories')->orderBy('created_at','desc')->get();
        return view('backend.pages.category.index',compact('categories'));
    }
    public function create()
    {
        return view('backend.pages.category.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        session()->flash('success', 'Category est créé !!');

        return redirect()->route('admin.categories.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->save();
        session()->flash('success', 'Categorie est modifié !!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();
        session()->flash('success', 'Categorie est supprimé !!');
        return redirect()->back();
    }
}
