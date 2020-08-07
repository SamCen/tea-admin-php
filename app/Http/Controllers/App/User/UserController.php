<?php

namespace App\Http\Controllers\App\User;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function selectList(Request $request,UserService $userService)
    {
        return success($userService->selectList());
    }
}
