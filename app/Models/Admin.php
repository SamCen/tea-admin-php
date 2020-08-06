<?php

namespace App\Models;

use App\Exceptions\GeneralException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $fillable = [
        'account','password','last_login_ip','status','name'
    ];

    protected $hidden = [
        'password','created_at','updated_at'
    ];

    /**
     * 禁用rememberToken
     * @var string
     */
    protected $rememberTokenName = '';

    /**
     * Author sam
     * DateTime 2019-05-22 17:19
     * Description:设置密码加密
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Author samcen
     * DateTime 2019-05-30 21:37
     * Description:IP地址入库转整形
     * @param $value
     */
    public function setLastLoginIpAttribute($value)
    {
        $this->attributes['last_login_ip'] = ip2long($value);
    }

    /**
     * Author samcen
     * DateTime 2019-05-30 21:40
     * Description:ip地址出库转ip格式
     * @return string
     */
    public function getLastLoginIpAttribute()
    {
        return long2ip($this->attributes['last_login_ip']);
    }


    public function getStatusAttribute()
    {
        return !empty($this->attributes['status']);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Author sam
     * DateTime 2019-06-03 10:24
     * Description:用户和角色多对多关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_role_pivot','admin_id','role_id');
    }

    /**
     * Author sam
     * DateTime 2019-06-11 10:17
     * Description:添加用户
     * @param $data
     * @return Admin|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws GeneralException
     */
    public static function createAdmin($data)
    {
        if(!empty($data['roles'])){
            DB::beginTransaction();
            try{
                /**
                 * @var $admin Admin
                 */
                $admin = self::query()->create($data);
                $admin->roles()->sync($data['roles']);
                DB::commit();
            }catch (\Exception $e){
                Log::error('添加用户失败：'.$e->getMessage());
                DB::rollBack();
                throw new GeneralException('服务器错误');
            }
        }else{
            $admin = self::query()->create($data);
        }
        return $admin;
    }
}
