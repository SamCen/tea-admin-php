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
        $user->fill($params);
        $user->save();
        return $user;
    }

    public function indexUser($params)
    {
        $page = !empty($params['page'])?$params['page']:1;
        $limit = !empty($params['limit'])?$params['limit']:10;
        return User::query()->paginate($limit,['*'],'page',$page);
    }
}
