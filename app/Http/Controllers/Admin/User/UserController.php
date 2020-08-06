<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserIndexRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserStoreRequest $request, UserService $userService)
    {
        return success($userService->storeUser($request->all()));
    }

    public function update(UserUpdateRequest $request, User $appUser, UserService $userService)
    {
        return success($userService->updateUser($appUser,$request->all()));
    }

    public function index(UserIndexRequest $request,UserService $userService)
    {
        return success($userService->indexUser($request->all()));
    }

    public function show($appUser,UserService $userService)
    {
        return success($userService->showUser($appUser));
    }

    public function getRoles(Request $request,UserService $userService)
    {
        return success($userService->getRoles());
    }
}
