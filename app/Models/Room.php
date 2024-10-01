<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'description',
        'old_price',
        'price',
        'published',
        'status',
        'category_room_id'
    ];

    public function booking(){
        return $this->hasMany('App\Models\Booking','room_id');
    }

    public function categoryRoom(){
        return $this->belongsTo('App\Models\CategoryRoom');
    }
}
