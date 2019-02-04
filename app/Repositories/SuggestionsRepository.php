<?php

namespace FacebookBot\Repositories;

use FacebookBot\Suggestion;
use Illuminate\Support\Facades\Redis;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessagesBuilderRepository
 *
 * @author gabriel
 */
class SuggestionsRepository
{

    public function statusStart($senderId)
    {
        Redis::set('suggestion::start::' . $senderId, 'started');
    }

    public function statusCheck($senderId)
    {
        return Redis::get('suggestion::start::' . $senderId);
    }

    public function statusStop($senderId)
    {
        Redis::del('suggestion::start::' . $senderId);
    }

    public function create($senderId, $message)
    {
        Suggestion::create([
            'user_face_id' => $senderId,
            'suggestion' => $message
        ]);
    }

}
