<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'subject',
        'message'
    ];
}
