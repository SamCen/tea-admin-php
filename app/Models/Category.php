<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_name'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function records()
    {
        return $this->hasManyThrough(
            'App\Models\OperationRecord',
            'App\Models\Product',
            'category_id',
            'product_id',
            'id',
            'id'
        );
    }
}
