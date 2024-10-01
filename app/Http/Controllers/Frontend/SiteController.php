<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Slider;
use App\Models\Actualite;
use App\Models\Event;
use App\Models\Room;
use App\Models\Testimonial;
use App\Models\Restauration;
use App\Models\Infrastructure;
use App\Models\Salle;
use App\Models\Booking;
use App\Models\About;
use App\Models\Subscriber;
use App\Models\Comment;
use App\Models\Gallerie;
use App\Models\Setting;
use App\Models\Paillote;
use App\Models\Team;
use App\Models\CategoryRestauration;
use App\Models\CategoryRoom;
use Mail;

class SiteController extends Controller
{
    //
    public function index(){

        $sliders = Slider::all();
        $restaurations = Restauration::paginate(9);
        $teams = Team::all();
        $rooms = Room::all();
        $salles = Salle::all();
        $paillotes = Paillote::all();
        $actualites = Actualite::orderBy('created_at','desc')->take(3)->get();
        $events = Event::orderBy('created_at','desc')->take(3)->get();
        $testimonials = Testimonial::all();
        $about = About::orderBy('created_at','desc')->first();
        $imageSlider = Slider::orderBy('created_at','desc')->first();
        $pictures = Gallerie::orderBy('created_at','desc')->get();
        $settings = Setting::orderBy('created_at','desc')->first();

        $categoryRestaurations = CategoryRestauration::orderBy('created_at','desc')->get();
        $restauration = Restauration::orderBy('created_at','desc')->first();
        $categoryRestauration = CategoryRestauration::orderBy('created_at','desc')->first();
        $total_rooms = count(Room::select('id')->get());
        $total_salles = count(Salle::select('id')->get());
        $total_teams = count(Team::select('id')->get());
        $total_customers = count(Booking::select('id')->get());

        return view('frontend.index',compact(
            'sliders',
            'restaurations',
            'teams',
            'rooms',
            'actualites',
            'about',
            'testimonials',
            'imageSlider',
            'events',
            'pictures',
            'salles',
            'paillotes',
            'categoryRestaurations',
            'categoryRestauration',
            'total_rooms',
            'total_salles',
            'total_teams',
            'total_customers',
            'restauration',
            'settings'
        ));
    }

    public function room(){

        $room = Room::orderBy('created_at','desc')->first();
        $rooms = Room::paginate(9);
        $categoryRooms = CategoryRoom::all();
        return view('frontend.rooms',compact('room','rooms','categoryRooms'));
    }

    public function salle(){

        $salle = Salle::orderBy('created_at','desc')->first();
        $salles = Salle::paginate(9);

        return view('frontend.salles',compact('salle','salles'));
    }

    public function infrastructure(){

        $infrastructure = Salle::orderBy('created_at','desc')->first();
        $infrastructures = Salle::orderBy('created_at','desc')->first();

        return view('frontend.infrastructures',compact('infrastructure','infrastructures'));
    }

    public function event(){
        return view('frontend.events');
    }

    public function news(){
        return view('frontend.news');
    }

    public function actualite()
    {
        $settings = Setting::orderBy('created_at','desc')->first();

        $actualites = Actualite::paginate(9);
        $about = About::orderBy('created_at','desc')->first();
        $services = Service::all();
        return view('frontend.actualite',compact('actualites','settings','about','services'));
    }

    public function actualiteShow($id)
    {
        //
        $settings = Setting::orderBy('created_at','desc')->first();
        $about = About::orderBy('created_at','desc')->first();
        $services = Service::all();
        $actualite = Actualite::findOrFail($id);
        $comments = Comment::where('actualite_id',$id)->where('published',1)->get();
        $total_comments = count(Comment::select('id')->where('actualite_id',$id)->where('published',1)->get());
        return view('frontend.publications.actualite-show',compact('actualite','settings','about','services','comments','total_comments'));
    }

    public function contact()
    {
        $settings = Setting::orderBy('created_at','desc')->first(); 
        $about = About::orderBy('created_at','desc')->first();
        $services = Service::all();

        return view('frontend.contact' ,compact('settings','about','services'));
    }

    public function postComment(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'actualite_id' => 'required',
            'email' => 'required'

        ]);

        $comment = new Comment();
        $comment->actualite_id = $request->actualite_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->web_site = $request->web_site;
        $comment->message = $request->message;
        $comment->save();


        $mailData = [
                    'title' => 'Remerciement',
                    'name' => $comment->name,
                    ];
         
        Mail::to($comment->email)->send(new CommentMail($mailData));

        session()->flash('success', 'Votre message a été envoyé!!');

        return redirect()->back();
    }

    public function postContact(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'sujet' => 'required',
            'message' => 'required'

        ]);

        $contact = new Contact();
        $contact->prenom = $request->prenom;
        $contact->nom = $request->nom;
        $contact->email = $request->email;
        $contact->sujet = $request->sujet;
        $contact->message = $request->message;
        $contact->save();


        $mailData = [
                    'title' => 'Message Envoyé',
                    'nom' => $contact->nom,
                    'prenom' => $contact->prenom,
                    ];
         
        Mail::to($contact->email)->send(new ContactMail($mailData));

        session()->flash('success', 'Votre message a été envoyé!!');

        return redirect()->back();
    }

    public function subscribe(Request $request)
    {
        //
        $request->validate([
            'email' => 'required|min:10|max:200|email|unique:subscribers'

        ]);

        $subscribe = new Subscriber();
        $subscribe->email = $request->email;
        $subscribe->save();

        $mailData = [
                    'title' => 'Abonnement'
                    ];
         
        Mail::to($subscribe->email)->send(new SubscriberMail($mailData));

        return redirect()->back();
    }
}
