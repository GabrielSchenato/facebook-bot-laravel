<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Suggestion;

class SuggestionsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Suggestion $model)
    {
        $this->model = $model;
    }

}
