<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
      'type', 'title', 'postback', 'message_id', 'webview_height_ratio'  
    ];
}
