<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restauration extends Model
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
        'category_restauration_id'
    ];

    public function booking(){
        return $this->hasMany('App\Models\Booking','restauration_id');
    }

    public function categoryRestauration(){
        return $this->belongsTo('App\Models\CategoryRestauration');
    }
}
