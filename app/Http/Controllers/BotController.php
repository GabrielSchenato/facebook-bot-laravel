<?php

namespace App\Http\Controllers;

use CodeBot\Build\Solid;
use CodeBot\Element\Button;
use CodeBot\Element\Product;
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
        $message = $sender->getMessage();
        $postback = $sender->getPostBack();
        
        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));
        Solid::setSender($senderId);
        
        if($postback){
            if(is_array($postback))
            {
                $postback = json_encode($postback);
            }
            $bot->message('text', 'Você chamou o postback'. $postback);
            return '';
        }
        
        $bot->message('text', 'Oii, eu sou um bot...');
        $bot->message('text', 'Você digitou: ' . $message);
        
        $bot->message('image', "https://www.aprenderexcel.com.br//imagens/post/385/2901-1.jpg");

        
        $buttons = [
            new Button('web_url', 'Google', 'https://www.google.com'),
            new Button('web_url', 'Code.Education', 'https://code.education')
        ];
        $bot->template('buttons', 'Que tal testarmos a abertura de um site?', $buttons);
        
        $products = [
            new Product(
                    'Produto 1', 'http://www.contabilidadetoledo.com.br/wp-content/uploads/2017/11/20171123.jpg', 'Curso de angular', new Button('web_url', null, 'https://angular.io')
            ),
            new Product(
                    'Produto 2', 'https://mestredoadwords.com.br/wp-content/uploads/2016/12/vender-produtos.png', 'Curso de php', new Button('web_url', null, 'http://php.net')
            ),
        ];
        
        $bot->template('generic', '', $products);
        
        $bot->template('list', '', $products);
        
        return '';
    }

}
