<?php
/**
 * Author sam
 * DateTime 2019-06-03 10:54
 * Description:
 */

namespace App\Contract;


class RedisKey
{
    /**
     * 后台用户权限
     */
    const ADMIN_PRIVILEGES = 'admin:privileges';

    /**
     * 后台用户菜单
     */
    const ADMIN_MENUS = 'admin:menus';

    /**
     * 用户授权登录码获取的openid
     */
    const USER_WXCODE_OPENID = 'user:wx_code:%s';
}
