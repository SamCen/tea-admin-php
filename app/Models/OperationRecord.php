<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationRecord extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'action', 'num', 'operation_date', 'op_user_id'];
}
