<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuButton extends Model
{
    protected $timestamps = false;
    protected $fillable = ['type', 'title', 'value', 'parent_id', 'menu_id'];
}
