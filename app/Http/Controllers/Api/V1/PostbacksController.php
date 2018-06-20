<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Postback;
use CodeBot\Build\Solid;

class PostbacksController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Postback $model)
    {
        $this->model = $model;
    }

    public function setGetStarted($id)
    {
        $postback = Postback::where('id', $id)->firtOrFail();

        Postback::where(['get_started' => true])
                ->update(['get_started' => false]);

        $postback->get_started = true;
        $postback->save();

        $bot = Solid::factory();
        Solid::setPageAccessToken(config('botfb.pageAccessToken'));

        $bot->addGetStartedButton($postback->value);
    }

}
