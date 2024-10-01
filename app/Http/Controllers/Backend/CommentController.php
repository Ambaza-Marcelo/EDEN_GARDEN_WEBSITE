<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Comment;
use Mail;
use App\Mail\CommentMail;


class CommentController extends Controller
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
        $comments = DB::table('comments')->orderBy('created_at','desc')->get();
        return view('backend.pages.comment.index',compact('comments'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comment = Comment::findOrFail($id);
        return view('backend.pages.comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'

        ]);

        $comment = Comment::findOrFail($id);
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->message = $request->message;
        $comment->save();
        session()->flash('success', 'commentaire a été modifié!!');
        return redirect()->route('admin.comments.index');
    }

    public function publish($id)
    {
       if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        Comment::where('id', '=', $id)
                ->update(['published' => 1]);

        session()->flash('success', 'Le commentaire est publié !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Comment::findOrFail($id);
        $comment->delete();
        session()->flash('success', 'commentaire a été supprimé!!');
        return redirect()->back();
    }
}
