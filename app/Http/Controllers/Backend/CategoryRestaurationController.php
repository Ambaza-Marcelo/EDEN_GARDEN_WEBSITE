<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\CategoryRestauration;

class CategoryRestaurationController extends Controller
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
        $categories = DB::table('category_restaurations')->orderBy('created_at','desc')->get();
        return view('backend.pages.categoryRestauration.index',compact('categories'));
    }
    public function create()
    {
        return view('backend.pages.categoryRestauration.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $categoryRestauration = new CategoryRestauration();
        $categoryRestauration->name = $request->name;
        $categoryRestauration->save();

        session()->flash('success', 'Categorie est créé !!');

        return redirect()->route('admin.category_restaurations.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryRestauration  $categoryRestauration
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categoryRestauration = CategoryRestauration::findOrFail($id);
        return view('backend.pages.categoryRestauration.edit', compact('categoryRestauration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryRestauration  $categoryRestauration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $categoryRestauration = CategoryRestauration::findOrFail($id);

        $categoryRestauration->name = $request->name;
        $categoryRestauration->save();
        session()->flash('success', 'Categorie est modifié !!');
        return redirect()->route('admin.category_restaurations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryRestauration  $categoryRestauration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoryRestauration = CategoryRestauration::findOrFail($id);
        $categoryRestauration->delete();
        session()->flash('success', 'Categorie est supprimé !!');
        return redirect()->back();
    }
}
