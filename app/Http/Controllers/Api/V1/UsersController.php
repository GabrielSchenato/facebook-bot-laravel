<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\Controller;
use FacebookBot\User;

class UsersController extends Controller
{
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
