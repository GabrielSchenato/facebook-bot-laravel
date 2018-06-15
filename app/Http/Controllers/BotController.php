<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\Message\Image;
use CodeBot\Message\Text;
use CodeBot\SenderRequest;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\TemplatesMessage\GenericTemplate;
use CodeBot\TemplatesMessage\ListTemplate;
use CodeBot\Element\Button;
use CodeBot\Element\Product;
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
        
        $button = new Button('web_url', null, 'https://angular.io');
        $product = new Product('Produto 1', 'http://www.contabilidadetoledo.com.br/wp-content/uploads/2017/11/20171123.jpg', 'Curso de angular', $button);
        
        $button = new Button('web_url', null, 'http://php.net');
        $product2 = new Product('Produto 2', 'https://mestredoadwords.com.br/wp-content/uploads/2016/12/vender-produtos.png', 'Curso de php', $button);
        
        $template = new GenericTemplate($senderId);
        $template->add($product);
        $template->add($product2);     

        $callSendApi->make($template->message('Que tal testarmos a abertura de um site?'));
        
        $button = new Button('web_url', null, 'https://angular.io');
        $product = new Product('Produto 1', 'http://www.contabilidadetoledo.com.br/wp-content/uploads/2017/11/20171123.jpg', 'Curso de angular', $button);
        
        $button = new Button('web_url', null, 'http://php.net');
        $product2 = new Product('Produto 2', 'https://mestredoadwords.com.br/wp-content/uploads/2016/12/vender-produtos.png', 'Curso de php', $button);
        
        $template = new ListTemplate($senderId);
        $template->add($product);
        $template->add($product2);

        $callSendApi->make($template->message('Que tal testarmos a abertura de um site?'));
        
        return '';
    }

}
