<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\Postback;
use CodeBot\Build\Solid;
use GuzzleHttp\Exception\RequestException;

class PostbacksController extends Controller
{

    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['Messages'];

    public function __construct(Postback $model)
    {
        $this->model = $model;
    }

    public function setGetStartedButton($id)
    {
        $postback = Postback::where('id', $id)->firstOrFail();

        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));
        
        try {
            $bot->addGetStartedButton($postback->value);
        } catch (RequestException $e) {
            return (string) $e->getResponse()->getBody();
        }
        
        Postback::where(['get_started' => true])
                ->update(['get_started' => false]);
        
        $postback->get_started = true;
        $postback->save();

        return response()->json(['status' => 'ok']);
    }

    public function removeGetStartedButton()
    {
        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));

        try {
            $bot->removeGetStartedButton();
        } catch (RequestException $e) {
            return (string) $e->getResponse()->getBody();
        }

        Postback::where(['get_started' => true])
                ->update(['get_started' => false]);

        return response()->json(['status' => 'ok']);
    }

}
