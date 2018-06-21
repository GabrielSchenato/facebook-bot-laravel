<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postback extends Model
{

    protected $fillable = ['value'];
    protected $relationships = ['Messages'];

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

}
