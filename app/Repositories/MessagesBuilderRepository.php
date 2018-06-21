<?php

namespace App\Repositories;

use CodeBot\Bot;
use App\Message;

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
class MessagesBuilderRepository
{

    public function createMessage(Bot $bot, Message $message)
    {
        if ($message->template) {
            
        } else {
            $bot->message($message->type, $message->message);
        }
    }

}
