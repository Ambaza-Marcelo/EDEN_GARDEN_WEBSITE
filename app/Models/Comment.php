<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'web_site',
        'message',
        'actualite_id'
    ];

    public function actualite(){
        return $this->belongsTo('App\Models\Comment');
    }
}
