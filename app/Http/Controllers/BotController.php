<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\Message\Image;
use CodeBot\Message\Text;
use CodeBot\SenderRequest;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\Element\Button;
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
        $message = $sender->getMessage();

        $text = new Text($senderId);
        $callSendApi = new CallSendApi(config('botfb.pageAccessToken'));
        
        $callSendApi->make($text->message('Oii, eu sou um bot...'));
        $callSendApi->make($text->message('Você digitou: ' . $message));
        
        $image = new Image($senderId);
        $callSendApi->make($image->message("https://www.aprenderexcel.com.br//imagens/post/385/2901-1.jpg"));

        
        $buttons = new ButtonsTemplate($senderId);
        $buttons->add(new Button('web_url', 'Google', 'https://www.google.com'));
        $buttons->add(new Button('web_url', 'Code.Education', 'https://code.education'));   
        $callSendApi->make($buttons->message('Que tal testarmos a abertura de um site?'));

        return '';
    }

}
