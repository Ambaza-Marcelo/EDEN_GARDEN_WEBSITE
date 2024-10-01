<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Message;

class MessageController extends Controller
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
        if (is_null($this->user) || !$this->user->can('message.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }  

        $messages = DB::table('messages')->orderBy('created_at','desc')->get();
        return view('backend.pages.message.index',compact('messages'));
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('message.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }  
        return view('backend.pages.message.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->save();

        session()->flash('success', 'Message est créé !!');

        return redirect()->route('admin.messages.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('message.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }  
        //
        $message = Message::findOrFail($id);
        return view('backend.pages.message.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $message = Message::findOrFail($id);

        $message->name = $request->name;
        $message->save();
        session()->flash('success', 'Categorie est modifié !!');
        return redirect()->route('admin.messages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('message.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }  
        //
        $message = Message::findOrFail($id);
        $message->delete();
        session()->flash('success', 'Categorie est supprimé !!');
        return redirect()->back();
    }
}
