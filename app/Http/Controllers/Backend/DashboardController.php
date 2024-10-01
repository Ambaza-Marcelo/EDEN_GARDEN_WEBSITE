<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Salle;


class DashboardController extends Controller
{
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
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }


        $year = ['2023','2024','2025','2026','2027','2028','2029','2030'];
        
        $booking = [];
        foreach ($year as $key => $value) {
            $booking[] = Booking::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }


        $total_roles = count(Role::select('id')->get());
        $total_admins = count(Admin::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());
        $total_rooms = count(Room::select('id')->get());
        $total_salles = count(Salle::select('id')->get());


        return view('backend.pages.dashboard.index', 
            compact(
            'total_admins', 
            'total_roles', 
            'total_permissions',
            'total_rooms',
            'total_salles'

            ))->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('booking',json_encode($booking,JSON_NUMERIC_CHECK));
    }

    public function changeLang(Request $request){
        \App::setlocale($request->lang);
        session()->put("locale",$request->lang);

        return redirect()->back();
    }
}
