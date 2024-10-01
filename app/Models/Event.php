<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'image',
        'title',
        'description',
        'old_price',
        'price',
        'published'
    ];
}
