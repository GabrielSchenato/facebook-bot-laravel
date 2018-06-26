<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = ['locale', 'composer_input_disabled', 'facebook_diff'];

    public function menu_buttons()
    {
        return $this->hasMany(MenuButton::class);
    }

}
