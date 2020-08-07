<?php

namespace App\Services\Opertaion;

use App\Models\OperationRecord;
use App\Models\User;
use App\Services\Product\ProductService;
use Carbon\Carbon;

class OperationRecordService
{
    public function productService():ProductService
    {
        return getDependentObject($this,ProductService::class,'productService');
    }

    public function storeOperationRecord($params,User $user)
    {
        $operationRecord = new OperationRecord();
        $params['op_user_id'] = $user->id;
        $params['operation_date'] = Carbon::now()->toDateString();
        $operationRecord->fill($params);
        $operationRecord->save();
        return $operationRecord;
    }

    public function productSelectList()
    {
        return $this->productService()->productSelectList();
    }
}
