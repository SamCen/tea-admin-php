<?php
/**
 * Author sam
 * DateTime 2019-09-27 10:18
 * Description:
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Notice
 * @method static mixed wxSend($msg)
 * Author sam
 * DateTime 2019-09-27 10:21
 * Description:预警服务
 * @package App\Facades
 */
class Notice extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'notice';
    }
}
