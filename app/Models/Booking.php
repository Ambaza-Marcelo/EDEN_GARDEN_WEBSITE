<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'date',
        'time',
        'ofpeople',
        'message',
        'status',
        'restauration_id',
        'salle_id',
        'paillote_id',
        'room_id'
    ];

    public function room(){
        return $this->belongsTo('App\Models\Room');
    }

    public function restauration(){
        return $this->belongsTo('App\Models\Restauration');
    }

    public function salle(){
        return $this->belongsTo('App\Models\Salle');
    }

    public function paillote(){
        return $this->belongsTo('App\Models\paillote');
    }
}
