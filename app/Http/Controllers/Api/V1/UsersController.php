<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function me()
    {
        $result = \Auth::user();
        $user = [];
        if ($result) {
            $user = User::find($result->id);
        }

        return response()->json($user);
    }

}
