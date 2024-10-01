<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Subscriber;

class SubscriberController extends Controller
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
    	$subscribers = DB::table('subscribers')->orderBy('created_at','desc')->get();
    	return view('backend.pages.subscriber.index',compact('subscribers'));
    }
    public function create()
    {
    	return view('backend.pages.subscriber.create');
    }

     public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'required',

        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        session()->flash('success', 'vous etes abonné !!');

        return redirect()->route('admin.subscriber.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $subscriber = Subscriber::findOrFail($id);
        return view('backend.pages.subscriber.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'email' => 'required',

        ]);

        $subscriber = Subscriber::findOrFail($id);

        $subscriber->email = $request->email;
        $subscriber->save();
        session()->flash('success', 'Abonné est modifié !!');
        return redirect()->route('admin.subscriber.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        session()->flash('success', 'Abonné est supprimé !!');
        return redirect()->back();
    }
}
