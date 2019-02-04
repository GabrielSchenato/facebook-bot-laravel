<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\Element;

class ElementsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Element $model)
    {
        $this->model = $model;
    }

}
