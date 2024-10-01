<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paillote extends Model
{
    //
    protected $fillable = [
        'name',
        'ofpeople'
    ];


    public function booking(){
        return $this->hasMany('App\Models\Booking','paillote_id');
    }
}
