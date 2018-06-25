<?php

namespace App\Http\Controllers;

SendSuggestions;

use App\BotResources\SendSuggestions;
use App\Postback;
use App\Repositories\MessagesBuilderRepository;
use CodeBot\Build\Solid;
use CodeBot\Resources\Resolver;
use CodeBot\SenderRequest;
use CodeBot\WebHook;
use Illuminate\Http\Request;
use function abort;
use function config;

class BotController extends Controller
{

    public function subscribe()
    {
        $webHook = new WebHook;
        $subscribe = $webHook->check(config('botfb.validationToken'));
        if (!$subscribe) {
            abort(403, 'Unauthorized action.');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SenderRequest();
        $senderId = $sender->getSenderId();
        $postback = $sender->getPostBack();

        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));
        Solid::setSenderId($senderId);

        if ($postback === 'suggestion') {
            (new SendSuggestions)->statusStart($sender, $bot);
            return '';
        }

        $postback = Postback::where('value', $postback)->first();

        if (!$postback) {
            $botResourcesResolver = new Resolver;
            $botResourcesResolver->register(SendSuggestions::class);

            if ($botResourcesResolver->resolver($sender, $bot)) {
                return '';
            }
            $bot->message('text', 'Desculpe, eu não sei o que você quis dizer ):');
            $bot->message('text', 'Use o menu ao lado esquerdo do campo aonde você escreve para ver o que você pode fazer');
            return '';
        }

        foreach ($postback->messages as $message) {
            (new MessagesBuilderRepository)->createMessage($bot, $message);
        }

        return '';
    }

}
