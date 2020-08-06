<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['path','component','icon','meta'];

    /**
     * Author sam
     * DateTime 2019-06-03 15:09
     * Description:meta访问器
     * @param $value
     */
    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = json_encode($value,JSON_UNESCAPED_UNICODE);
    }

    /**
     * Author sam
     * DateTime 2019-06-03 15:09
     * Description:meta获取器
     * @return mixed
     */
    public function getMetaAttribute()
    {
        return json_decode($this->attributes['meta'],true);
    }
}
