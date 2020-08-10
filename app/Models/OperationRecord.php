<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationRecord extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'action', 'num', 'operation_date', 'op_user_id'];

    /**
     * Author Cjc
     * DateTime 2020/8/10 10:08 下午
     * Description:num 入库 * 100
     * @param $value
     */
    public function setNumAttribute($value)
    {
        $this->attributes['num'] = bcmul($value, 100);
    }

    /**
     * Author Cjc
     * DateTime 2020/8/10 10:09 下午
     * Description:num 出库  / 100 (保留两位小数)
     * @return string
     */
    public function getLastLoginIpAttribute()
    {
        return bcdiv($this->attributes['num'],100,2);
    }
}
