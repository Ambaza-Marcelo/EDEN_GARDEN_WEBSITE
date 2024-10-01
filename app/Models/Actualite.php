<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    //
    protected $fillable = [
    	'title',
    	'date',
		'image',
		'description',
        'category_id'
    ];


    public function category(){
        return $this->belongsTo('App\Models\Category');
    }


    public function comment(){
        return $this->hasMany('App\Models\Comment','actualite_id');
    }
}
