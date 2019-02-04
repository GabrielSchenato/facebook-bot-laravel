<?php

namespace FacebookBot;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'type', 'message', 'template', 'postback_id'
    ];

    public function elements()
    {
        return $this->hasMany('FacebookBot\Element');
    }

    public function products()
    {
        return $this->belongsToMany('FacebookBot\Product');
    }

}
