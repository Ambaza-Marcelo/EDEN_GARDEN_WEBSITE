<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySalle extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function salle(){
        return $this->hasMany('App\Models\Salle','category_salle_id');
    }
}
