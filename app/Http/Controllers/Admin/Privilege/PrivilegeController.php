<?php

namespace App\Http\Controllers\Admin\Privilege;

use App\Models\Privilege;
use App\Http\Controllers\Controller;
use App\Tools\Tree;

class PrivilegeController extends Controller
{
    /**
     * Author sam
     * DateTime 2019-06-11 11:24
     * Description:所有的权限列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $list = Privilege::query()->get()->toArray();
        $menus = Tree::getTree($list,'base','code','parent_code');
        return success($menus);
    }
}
