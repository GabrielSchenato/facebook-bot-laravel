<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\MenuButton;

class MenuButtonsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(MenuButton $model)
    {
        $this->model = $model;
    }

}
