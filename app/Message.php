<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'type', 'message', 'template', 'postback_id'
    ];
    
    public function elements()
    {
        return $this->hasMany('App\Element');
    }
    
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
