<?php

namespace FacebookBot\BotResources;

use FacebookBot\Repositories\SuggestionsRepository;
use CodeBot\Bot;
use CodeBot\Resources\ResourceInterface;
use CodeBot\SenderRequest;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendSuggestions
 *
 * @author gabriel
 */
class SendSuggestions implements ResourceInterface
{

    public function __invoke(SenderRequest $sender, Bot $bot): bool
    {
        $suggestion = new SuggestionsRepository;

        if ($suggestion->statusCheck($sender->getSenderId()) === 'started') {
            $suggestion->create($sender->getSenderId(), $sender->getMessage());

            $bot->message('text', 'Obrigado, sua sugestão foi enviada com sucesso!');
            $suggestion->statusStop($sender->getSenderId());

            return true;
        }
        return false;
    }

    public function statusStart(SenderRequest $sender, Bot $bot)
    {
        (new SuggestionsRepository())->statusStart($sender->getSenderId());
        $bot->message('text', 'Ok, por favor, qual sua sugestão?');
        $bot->message('text', 'Você pode digitar, mas envie a sua sugestão em uma única mensagem!');
    }

}
