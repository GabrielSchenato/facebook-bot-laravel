<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\MenuButton;

class MenuButtonsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(MenuButton $model)
    {
        $this->model = $model;
    }

}
