<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Product;

class ProductsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

}
