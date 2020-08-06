<?php

namespace App\Services\Opertaion;

use App\Models\OperationRecord;
use App\Models\User;
use Carbon\Carbon;

class OperationRecordService
{
    public function storeOperationRecord($params,User $user)
    {
        $operationRecord = new OperationRecord();
        $params['op_user_id'] = $user->id;
        $params['operation_date'] = Carbon::now()->toDateString();
        $operationRecord->fill($params);
        $operationRecord->save();
        return $operationRecord;
    }
}
