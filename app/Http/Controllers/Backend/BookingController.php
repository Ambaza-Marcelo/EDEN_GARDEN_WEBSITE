<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Models\Booking;
use \App\Models\Salle;
use \App\Models\Room;
use \App\Models\Paillote;
use \App\Models\Restauration;

use Mail;
use App\Mail\BookingConfirmationMail;
use App\Mail\BookingMail;

class BookingController extends Controller
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
         if (is_null($this->user) || !$this->user->can('reservation.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any booking !');
        }

        $bookings = Booking::with('room')->with('paillote')->with('salle')->orderBy('created_at','desc')->get();
        //$bookings = DB::table('bookings')->orderBy('created_at','desc')->get();
        return view('backend.pages.booking.index',compact('bookings'));
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'date' => 'required',
            'time' => 'required',
            'message' => 'required',
            'ofpeople' => 'required'

        ]);

        $booking = new Booking();
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone_no = $request->phone_no;
        $booking->date = $request->date;
        $booking->time = $request->time;
        $booking->message = $request->message;
        $booking->ofpeople = $request->ofpeople;
        $booking->room_id = $request->room_id;
        $booking->restauration_id = $request->restauration_id;
        $booking->salle_id = $request->salle_id;
        $booking->paillote_id = $request->paillote_id;
        $booking->save();
        
        $chambre = Room::where('id',$booking->room_id)->value('title');
        $paillote = Paillote::where('id',$booking->paillote_id)->value('name');
        $salle = Salle::where('id',$booking->salle_id)->value('title');

        $email = $booking->email;

        $mailData = [
                    'title' => 'Reservation',
                    'nom' => $booking->name,
                    'email' => $email,
                    'ofpeople' => $booking->ofpeople,
                    'date' => $booking->date,
                    'phone_no' => $booking->phone_no,
                    'time' => $booking->time,
                    'chambre' => $chambre,
                    'paillote' => $paillote,
                    'salle' => $salle,
                    ];
         
        Mail::to($email)->send(new BookingMail($mailData));

        session()->flash('success', 'Votre Reservation est faite avec succes,vous serez confirmé par E-mail plus tard');

        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $booking = Booking::findOrFail($id);
        return view('backend.pages.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    }

    public function confirm($id)
    {
       if (is_null($this->user) || !$this->user->can('reservation.confirm')) {
            abort(403, 'Sorry !! You are Unauthorized to validate any booking !');
        }

        Booking::where('id', '=', $id)
                ->update(['status' => 1]);

        $room_id = Booking::where('room_id',$id)->value('room_id');
        $paillote_id = Booking::where('paillote_id',$id)->value('paillote_id');
        $salle_id = Booking::where('salle_id',$id)->value('salle_id');

        if (!empty($booking->room_id)) {
            Room::where('id', '=', $booking->room_id)
                ->update(['status' => 1]);
        }elseif (!empty($booking->paillote_id)) {
            Paillote::where('id', '=', $booking->paillote_id)
                ->update(['status' => 1]);
        }elseif(!empty($booking->salle_id)){
            Salle::where('id', '=', $booking->salle_id)
                ->update(['status' => 1]);
        }

        $auteur = $this->user->name;
        $nom = Booking::where('id',$id)->value('name');
        $email = Booking::where('id',$id)->value('email');
        $date = Booking::where('id',$id)->value('date');
        $time = Booking::where('id',$id)->value('time');
        $chambre = Room::where('id',$room_id)->value('title');
        $paillote = Paillote::where('id',$paillote_id)->value('name');
        $salle = Salle::where('id',$salle_id)->value('title');

        $mailData = [
                    'title' => 'Reservation',
                    'auteur' => $auteur,
                    'nom' => $nom,
                    'email' => $email,
                    'date' => $date,
                    'time' => $time,
                    'chambre' => $chambre,
                    'paillote' => $paillote,
                    'salle' => $salle,
                    ];
         
        Mail::to($email)->send(new BookingConfirmationMail($mailData));

        session()->flash('success', 'vous venez de confirmer la reservation!!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if (is_null($this->user) || !$this->user->can('reservation.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any booking !');
        }
        //
        $booking = Booking::findOrFail($id);
        $booking->delete();
        session()->flash('success', 'Resevation a été supprimé!!');
        return redirect()->back();
    }
}
