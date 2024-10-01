<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRestauration extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function restauration(){
        return $this->hasMany('App\Models\Restauration','category_restauration_id');
    }
}
