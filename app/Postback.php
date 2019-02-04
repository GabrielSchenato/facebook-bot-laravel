<?php

namespace FacebookBot;

use Illuminate\Database\Eloquent\Model;

class Postback extends Model
{

    protected $fillable = ['value'];
    protected $relationships = ['Messages'];

    public function messages()
    {
        return $this->hasMany('FacebookBot\Message');
    }

}
