<?php

namespace App\Repositories;

use App\Message;
use CodeBot\Bot;
use CodeBot\Element\Button;
use CodeBot\Element\Product;

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
            call_user_func_array([$this, $message->type], [$bot, $message]);
        } else {
            $bot->message($message->type, $message->message);
        }
    }

    private function buttons(Bot $bot, Message $message)
    {
        $elements = [];

        foreach ($message->elements as $element) {
            $config = [];
            if ($element->webview_height_ratio) {
                $config['webview_height_ratio'] = $element->webview_height_ratio;
            }
            $elements[] = new Button($element->type, $element->title, $element->postback, $config);
        }

        $bot->template($message->type, $message->message, $elements);
    }

    private function generic(Bot $bot, Message $message)
    {
        $products = [];

        foreach ($message->products as $product) {
            $default_action = new Button('web_url', null, $product->url);
            $products[] = new Product($product->title, $product->image_full_url, $product->subtitle, $default_action);
        }

        $bot->message('text', $message->message);
        $bot->template($message->type, $message->message, $products);
    }

}
