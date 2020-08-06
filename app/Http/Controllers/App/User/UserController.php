<?php

namespace App\Http\Controllers\App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\User\UserIndexRequest;
use App\Http\Requests\App\User\UserStoreRequest;
use App\Http\Requests\App\User\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function store(UserStoreRequest $request, UserService $userService)
    {
        return success($userService->storeUser($request->all()));
    }

    public function update(UserUpdateRequest $request, User $user, UserService $userService)
    {
        return success($userService->updateUser($user,$request->all()));
    }

    public function index(UserIndexRequest $request,UserService $userService)
    {
        return success($userService->indexUser($request->all()));
    }
}
