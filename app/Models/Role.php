<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name','is_admin'];

    protected $hidden = ['pivot'];

    /**
     * Author sam
     * DateTime 2019-06-03 10:25
     * Description:角色和用户多对多关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins()
    {
        return $this->belongsToMany(Admin::class,'admin_role_pivot','role_id','admin_id');
    }

    /**
     * Author sam
     * DateTime 2019-06-03 15:20
     * Description:角色和权限的多对多关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class,'role_privilege_pivot','role_id','privilege_code');
    }
}
