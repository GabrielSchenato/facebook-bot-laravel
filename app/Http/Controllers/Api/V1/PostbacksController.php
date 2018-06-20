<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Postback;

class PostbacksController extends Controller
{
    use ApiControllerTrait;
    
    protected $model;
    
    public function __construct(Postback $model)
    {
        $this->model = $model;
    }

}
