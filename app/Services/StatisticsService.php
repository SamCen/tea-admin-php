<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function sumStatistics($params)
    {
        $query = Product::query();
        if (!empty($params['product_id'])) {
            $query->where('id', $params['product_id']);
        }
        $list = $query->select(['product_name', 'product_unit'])->withCount([
            'records as input' => function ($query) use ($params) {
                if(!empty($params['beginDate'])){
                    $query->where('operation_date','>=',$params['beginDate']);
                }
                if(!empty($params['endDate'])){
                    $query->where('operation_date','<=',$params['beginDate']);
                }
                $query->where('operation_records.action', 'input')->select(DB::raw('sum(operation_records.num) as input_sum'));
            }, 'records as output' => function ($query) use ($params) {
                if(!empty($params['beginDate'])){
                    $query->where('operation_date','>=',$params['beginDate']);
                }
                if(!empty($params['endDate'])){
                    $query->where('operation_date','<=',$params['beginDate']);
                }
                $query->where('operation_records.action', 'output')->select(DB::raw('sum(operation_records.num) as input_sum'));
            }
        ])->get();
        $list->map(function($item){
            $item->input = $item->input?bcdiv($item->input,100,2):0;
            $item->output = $item->input?bcdiv($item->output,100,2):0;
            $item->storage = bcdiv(($item->input - $item->output),1,2);
            return $item;
        });
        return $list;
    }
}
