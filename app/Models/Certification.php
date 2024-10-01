<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    //
    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'description'
    ];
}
