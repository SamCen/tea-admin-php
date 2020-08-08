<?php

namespace App\Http\Controllers\App\Auth;

use App\Contract\RedisKey;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Auth\BindUserRequest;
use App\Http\Requests\App\Auth\LoginRequest;
use App\Http\Requests\App\Auth\WechatLoginRequest;
use App\Models\User;
use App\Services\WechatService;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

    public function wechatLogin(WechatLoginRequest $request,Hasher $hasher)
    {
        $code = $request->get('code');
        $wxService  = new WechatService(config('wechat.wx_appid'),config('wechat.wx_secret'));
        $res = $wxService->getUserInfoByCode($code);
        $credentials = [
            'openid'=>$res['openid'],
        ];
        $provider = new EloquentUserProvider($hasher, User::class);
        $user = $provider->retrieveByCredentials($credentials);
        if(!$user){
            $response = [
                'access_token' => null,
                'code'=>encrypt($code),
            ];
            $cacheKey = sprintf(RedisKey::USER_WXCODE_OPENID,$code);
            Cache::put($cacheKey,encrypt($res['openid']),600);
        }else{
            if (! $token = Auth::guard('user')->login($user)) {
                return error('获取登录凭证失败', 400);
            }
            $role = $user->role;
            $user->last_login_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:'127.0.0.1';
            $user->save();
            $response = [
                'role'=>$role,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('user')->factory()->getTTL() * 60
            ];
        }


        return success($response);
    }

    public function bindUser(BindUserRequest $request,Hasher $hasher)
    {
        $credentials = [
            'phone'=>$request->get('phone'),
        ];
        $code = decrypt($request->get('code'));
        $cacheKey = sprintf(RedisKey::USER_WXCODE_OPENID,$code);
        $openid = Cache::pull($cacheKey);
        if(empty($openid)){
            return error('code 已失效',400);
        }

        $provider = new EloquentUserProvider($hasher, User::class);
        $user = $provider->retrieveByCredentials($credentials);
        if(!$user){
            error('没有找到手机号对应的用户');
        }
        if (! $token = Auth::guard('user')->login($user)) {
            return error('绑定失败', 400);
        }
        $role = $user->role;
        $user->last_login_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:'127.0.0.1';
        $user->openid = $openid;
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
