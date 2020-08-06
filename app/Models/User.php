<?php

namespace App\Models;

use App\Exceptions\GeneralException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User  extends Authenticatable implements JWTSubject
{
    protected $fillable = ['username','password','last_login_time','phone','openid','role'];

    protected $hidden = ['created_at','updated_at','password'];

    const ROLE_OPERATION = 1;

    const ROLE_ADMIN = 2;


    const APP_USER_ROLE_LIST = [
        [
            'name'=>'数据输入',
            'id'=>self::ROLE_OPERATION,
        ],
        [
            'name'=>'管理',
            'id'=>self::ROLE_ADMIN,
        ]
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setOpenidAttribute($value)
    {
        if(empty($value)){
            $this->attributes['password'] = ' ';
        }
    }

    public function setLastLoginIpAttribute($value)
    {
        $this->attributes['last_login_ip'] = ip2long($value);
    }

    public function getLastLoginIpAttribute()
    {
        return long2ip($this->attributes['last_login_ip']);
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
}
