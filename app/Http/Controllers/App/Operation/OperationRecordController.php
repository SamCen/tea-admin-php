<?php

namespace App\Http\Controllers\App\Operation;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Operation\OperationRecordStoreRequest;
use App\Services\Opertaion\OperationRecordService;
use Illuminate\Http\Request;

class OperationRecordController extends Controller
{
    public function store(OperationRecordStoreRequest $request,OperationRecordService $operationRecordService)
    {
        $operationRecordService->storeOperationRecord($request->all(),$request->user());
        return success();
    }


    public function productSelectList(Request $request,OperationRecordService $operationRecordService)
    {
        return success($operationRecordService->productSelectList());
    }
}
