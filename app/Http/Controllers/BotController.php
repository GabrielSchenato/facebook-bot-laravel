<?php

namespace App\Http\Controllers;

use App\Postback;
use App\Repositories\MessagesBuilderRepository;
use CodeBot\Build\Solid;
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
        
        $postback = Postback::where('value',$postback)->first();
        
        foreach ($postback->messages as $message) {
            (new MessagesBuilderRepository)->createMessage($bot, $message);
        }
        
        return '';
    }

}
