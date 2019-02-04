<?php

namespace FacebookBot;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{

    protected $fillable = ['user_face_id', 'suggestion', 'readed'];

}
