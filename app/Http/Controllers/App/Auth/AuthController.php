<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            'username'=>$request->get('username'),
            'password'=>$request->get('password'),
        ];

        if (! $token = auth('user')->attempt($credentials)) {
            return error('账号或密码不正确',401);
        }
        $user = Auth::guard('user')->user();
        $role = $user->role;
        $user->last_login_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:'127.0.0.1';
        $user->save();
        $response = [
            'role'=>$role,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('user')->factory()->getTTL() * 60
        ];
        return success($response);
    }
}
