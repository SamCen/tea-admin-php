<?php

namespace App\Http\Controllers\Admin\User;

use App\Contract\RedisKey;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminIndexRequest;
use App\Http\Requests\Admin\User\AdminStoreRequest;
use App\Models\Admin;
use App\Models\Menu;
use App\Models\Privilege;
use App\Tools\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    /**
     * Author sam
     * DateTime 2019-06-03 17:03
     * Description:获取用户信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo()
    {
        /**
         * @var $user Admin
         */
        $user = Auth::user();
        $menus = $this->getMenus($user);
        $user->menus = $menus;
        return success($user);
    }

    /**
     * Author sam
     * DateTime 2019-06-04 11:50
     * Description:获取菜单
     * @param $user
     * @return array|\Illuminate\Support\Collection
     */
    protected function getMenus($user)
    {
        $privileges = $this->getPrivileges($user);
        $redisKey = RedisKey::ADMIN_MENUS;
        if ($menus = Redis::hget($redisKey, $user->id)) {
            return $this->buildMenus(json_decode($menus,true));
        } else {
            $menus = [];
            foreach ($privileges as $privilege) {
                if ($privilege->menu_id) {
                    $menus[] = Menu::where('id',$privilege->menu_id)->first();
                }
            }
            $menus = collect($menus);
            Redis::hset($redisKey, $user->id, json_encode($menus));
            Redis::expire($redisKey, 86400);
            return $this->buildMenus($menus);
        }

    }

    /**
     * Author sam
     * DateTime 2019-06-04 11:49
     * Description:获取用户的权限
     * @param $user
     * @return array|mixed
     */
    protected function getPrivileges($user)
    {
        $redisKey = RedisKey::ADMIN_PRIVILEGES;
        if ($privileges = Redis::hget($redisKey, $user->id)) {
            return json_decode($privileges);
        } else {
            $privileges = [];
            if ($user->id == 1) {
                foreach (Privilege::get() as $privilege) {
                    $privileges[$privilege->code] = $privilege;
                }
            } else {
                $roles = $user->roles;
                foreach ($roles as $role) {
                    foreach ($role->privileges as $privilege) {
                        $privileges[$privilege->code] = $privilege;
                    }
                }
            }
            Redis::hset($redisKey, $user->id, json_encode($privileges));
            Redis::expire($redisKey, 86400);
            return $privileges;
        }
    }

    /**
     * Author sam
     * DateTime 2019-06-04 11:49
     * Description:生成菜单树
     * @param $data
     * @return array|\Illuminate\Support\Collection
     */
    protected function buildMenus($data)
    {
        $menus = collect($data)->sortBy('id');
        $menus->values()->all();
        $menus = Tree::getTree($menus,0,'id','parent_id');
        return $menus;
    }

    /**
     * Author sam
     * DateTime 2019-06-05 10:35
     * Description:账号列表
     * @param AdminIndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AdminIndexRequest $request)
    {
        $size = $request->get('size',10);
        $page = $request->get('page',1);
        $status = $request->get('status');
        $account = $request->get('account');
        $query = Admin::query();
        if($status==='0'||$status){
            $query->where('status',$status);
        }
        if($account){
            $query->where('account','like',"%{$account}%");
        }

        $list = $query->where('id','>',1)->orderByDesc('created_at')->paginate($size,['*'],'page',$page);
        return success($list);
    }

    /**
     * Author sam
     * DateTime 2019-06-05 17:27
     * Description:用户详情
     * @param Admin $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Admin $user)
    {
        $user->roles = $user->roles;
        return success($user);
    }

    /**
     * Author sam
     * DateTime 2019-06-10 15:39
     * Description:修改用户信息
     * @param Request $request
     * @param Admin $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Admin $user)
    {
        $data['account'] = $request->get('account');
        $data['name'] = $request->get('name');
        $data['status'] = $request->get('status')?1:0;
        if($request->get('password')){
            $data['password'] = $request->get('password');
        }
        $user->fill($data);
        return success($data);
    }

    /**
     * Author sam
     * DateTime 2019-06-10 16:20
     * Description:修改用户关联角色
     * @param Request $request
     * @param Admin $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRole(Request $request,Admin $user)
    {
        $roles = $request->get('roles');
        $user->roles()->sync($roles);
        return success();
    }


    public function store(AdminStoreRequest $request)
    {
        $data['account'] = $request->get('account');
        $data['password'] = $request->get('password');
        $data['name'] = $request->get('name');
        $data['status'] = $request->get('status')?1:0;
        $data['roles'] = $request->get('roles');
        $admin = Admin::createAdmin($data);
        return success($admin);
    }
}
