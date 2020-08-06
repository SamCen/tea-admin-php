<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_name','product_unit','category_id'];


    public function records()
    {
        return $this->hasMany('App\Models\OperationRecord');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    const UNIT_LIST = [
        '斤',
        '罐',
        '袋',
    ];
}
