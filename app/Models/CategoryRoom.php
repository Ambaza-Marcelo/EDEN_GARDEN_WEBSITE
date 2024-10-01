<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRoom extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function room(){
        return $this->hasMany('App\Models\Room','category_room_id');
    }
}
