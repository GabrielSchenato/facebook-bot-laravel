<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'type', 'message', 'template', 'postback_id'
    ];
}
