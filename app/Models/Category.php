<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function actualite(){
        return $this->hasMany('App\Models\Actualite','category_id');
    }
}
