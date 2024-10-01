<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
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
        'category_salle_id'
    ];

    public function booking(){
        return $this->hasMany('App\Models\Booking','salle_id');
    }

    public function categorySalle(){
        return $this->belongsTo('App\Models\CategorySalle');
    }
}
