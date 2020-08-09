<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function storeUser($params)
    {
        $user = new User();
        $user->fill($params);
        $user->save();
        return $user;
    }

    public function updateUser(User $user,$params)
    {
//        $phoneExist = User::query()
//            ->where('id','<>',$user->id)
//            ->where('phone',$params['phone'])
//            ->first();
//        if($phoneExist){
//            return error('手机号已存在',422);
//        }
        $user->fill($params);
        $user->save();
        return $user;
    }

    public function indexUser($params)
    {
        $page = !empty($params['page'])?$params['page']:1;
        $limit = !empty($params['limit'])?$params['limit']:10;
        $query = User::query();
        if(!empty($params['username'])){
            $query->where('username','like',"%{$params['username']}%");
        }
        if(!empty($params['phone'])){
            $query->where('phone','like',"%{$params['phone']}%");
        }
        return $query->paginate($limit,['*'],'page',$page);
    }

    public function getRoles()
    {
        return User::APP_USER_ROLE_LIST;
    }

    public function showUser($userId)
    {
        return User::query()->find($userId);
    }

    public function selectList()
    {
        return User::query()->select('username as text')->get();
    }

}
