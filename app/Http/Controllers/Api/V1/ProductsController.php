<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\Product;

class ProductsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

}
