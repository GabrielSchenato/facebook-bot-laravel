<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\Suggestion;

class SuggestionsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Suggestion $model)
    {
        $this->model = $model;
    }

}
