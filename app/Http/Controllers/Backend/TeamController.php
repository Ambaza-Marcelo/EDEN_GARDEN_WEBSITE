<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Team;
use \App\Models\Position;
use Validator;

class TeamController extends Controller
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
        if (is_null($this->user) || !$this->user->can('team.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $teams = DB::table('teams')->orderBy('created_at','desc')->get();
        return view('backend.pages.team.index',compact('teams'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('team.create')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }

        $positions = Position::all();
        return view('backend.pages.team.create',compact('positions'));
    }

    public function store(Request $request)
    {
        //
        $rules = array(
            'name' => 'required',
            'position_id' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:3072'
            );

            $error = Validator::make($request->all(),$rules);

            if($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all(),
                ]);
            }

        $name = $request->name;
        $position_id = $request->position_id;
        $description = $request->description;

        $storagepath = $request->file('image')->store('public/team');
        $fileName = basename($storagepath);

        $picture['image'] = $fileName;

        $data = new Team();
        $data->name = $name;
        $data->position_id = $position_id;
        $data->description = $description;
        $data->image = $picture['image'];
        $data->save();
        session()->flash('success', 'Equipe a été créé!!');

        return redirect()->route('admin.teams.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('team.edit')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $positions = Position::all();
        $team = Team::findOrFail($id);
        return view('backend.pages.team.edit', compact('team','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'position_id' => 'required',

        ]);

        $team = Team::findOrFail($id);

        $data = $request->all();

        if($request->hasFile('image')){
            $file_path = "public/team".$team->image;
            Storage::delete($file_path);

            $storagepath = $request->file('image')->store('public/teams');
            $fileName = basename($storagepath);
            $data['image'] = $fileName;

        }

        $team->fill($data);
        $team->save();
        session()->flash('success', 'Equipe a été modifié!!');
        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('team.delete')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        //
        $team = Team::findOrFail($id);
        $file_path = "public/team/".$team->image;
            Storage::delete($file_path);
        $team->delete();
        session()->flash('success', 'Equipe a été supprimé!!');
        return redirect()->back();
    }
}
