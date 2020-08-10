<?php

use Illuminate\Database\Seeder;

class PrivilegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = \Illuminate\Support\Facades\DB::table('privileges');
        $data = [
            [
                'code'=>'home',
                'parent_code'=>'base',
                'name'=>'首页权限',
                'menu_id'=>1,
                'type'=>'menu',
            ],
            [
                'code'=>'admin',
                'parent_code'=>'base',
                'name'=>'后台用户管理',
                'menu_id'=>2,
                'type'=>'menu',
            ],
            [
                'code'=>'role',
                'parent_code'=>'base',
                'name'=>'角色管理权限',
                'menu_id'=>3,
                'type'=>'menu',
            ],
            [
                'code'=>'user',
                'parent_code'=>'base',
                'name'=>'手机用户管理权限',
                'menu_id'=>4,
                'type'=>'menu',
            ],
            [
                'code'=>'statistics',
                'parent_code'=>'base',
                'name'=>'数据统计查看权限',
                'menu_id'=>12,
                'type'=>'menu',
            ],
            [
                'code'=>'product',
                'parent_code'=>'base',
                'name'=>'产品科目管理',
                'menu_id'=>8,
                'type'=>'menu',
            ],
            [
                'code'=>'product-list',
                'parent_code'=>'product',
                'name'=>'产品科目列表',
                'menu_id'=>10,
                'type'=>'menu',
            ],
//            [
//                'code'=>'product-add',
//                'parent_code'=>'product',
//                'name'=>'产品科目添加权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'product-edit',
//                'parent_code'=>'product',
//                'name'=>'产品科目修改权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'product-delete',
//                'parent_code'=>'product',
//                'name'=>'产品科目删除权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
            [
                'code'=>'category',
                'parent_code'=>'base',
                'name'=>'科目分类管理',
                'menu_id'=>9,
                'type'=>'menu',
            ],
            [
                'code'=>'category-list',
                'parent_code'=>'category',
                'name'=>'科目分类列表',
                'menu_id'=>11,
                'type'=>'menu',
            ],
//            [
//                'code'=>'category-add',
//                'parent_code'=>'category',
//                'name'=>'科目分类添加权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'category-edit',
//                'parent_code'=>'category',
//                'name'=>'科目分类修改权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'category-delete',
//                'parent_code'=>'category',
//                'name'=>'科目分类删除权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
            [
                'code'=>'statistics',
                'parent_code'=>'statistics',
                'name'=>'数据统计列表权限',
                'menu_id'=>13,
                'type'=>'menu',
            ],
            [
                'code'=>'admin-list',
                'parent_code'=>'admin',
                'name'=>'后台用户列表权限',
                'menu_id'=>5,
                'type'=>'menu',
            ],
//            [
//                'code'=>'admin-add',
//                'parent_code'=>'admin',
//                'name'=>'后台用户添加权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'admin-edit',
//                'parent_code'=>'admin',
//                'name'=>'后台用户修改权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'admin-delete',
//                'parent_code'=>'admin',
//                'name'=>'后台用户删除权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
            [
                'code'=>'role-list',
                'parent_code'=>'role',
                'name'=>'角色列表权限',
                'menu_id'=>6,
                'type'=>'button',
            ],
//            [
//                'code'=>'role-add',
//                'parent_code'=>'role',
//                'name'=>'角色添加权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'role-edit',
//                'parent_code'=>'role',
//                'name'=>'角色修改权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'role-delete',
//                'parent_code'=>'role',
//                'name'=>'角色删除权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
            [
                'code'=>'user-list',
                'parent_code'=>'user',
                'name'=>'手机用户列表权限',
                'menu_id'=>7,
                'type'=>'menu',
            ],
//            [
//                'code'=>'user-add',
//                'parent_code'=>'user',
//                'name'=>'手机用户添加权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'user-edit',
//                'parent_code'=>'user',
//                'name'=>'手机用户修改权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
//            [
//                'code'=>'user-delete',
//                'parent_code'=>'user',
//                'name'=>'手机用户删除权限',
//                'menu_id'=>null,
//                'type'=>'button',
//            ],
        ];
        $table->truncate();
        $table->insert($data);
    }
}
