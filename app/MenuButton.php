<?php

namespace FacebookBot;

use Illuminate\Database\Eloquent\Model;

class MenuButton extends Model
{

    public $timestamps = false;
    protected $fillable = ['type', 'title', 'value', 'parent_id', 'menu_id'];

}
