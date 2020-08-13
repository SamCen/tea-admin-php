<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function sumStatistics($params)
    {
        $list = [];
        $productQuery = Product::query();
        if (!empty($params['product_id'])) {
            $productQuery->where('id', $params['product_id']);
        }
        $productList = $productQuery->select(['product_name', 'product_unit','category_id'])->withCount([
            'records as input' => function ($query) use ($params) {
                if(!empty($params['beginDate'])){
                    $query->where('operation_date','>=',$params['beginDate']);
                }
                if(!empty($params['endDate'])){
                    $query->where('operation_date','<=',$params['endDate']);
                }
                $query->where('operation_records.action', 'input')->select(DB::raw('sum(operation_records.num) as input_sum'));
            }, 'records as output' => function ($query) use ($params) {
                if(!empty($params['beginDate'])){
                    $query->where('operation_date','>=',$params['beginDate']);
                }
                if(!empty($params['endDate'])){
                    $query->where('operation_date','<=',$params['endDate']);
                }
                $query->where('operation_records.action', 'output')->select(DB::raw('sum(operation_records.num) as input_sum'));
            },'records as fix_input' => function ($query) use ($params) {
                if(!empty($params['beginDate'])){
                    $query->where('operation_date','>=',$params['beginDate']);
                }
                if(!empty($params['endDate'])){
                    $query->where('operation_date','<=',$params['endDate']);
                }
                $query->where('operation_records.action', 'fix_input')->select(DB::raw('sum(operation_records.num) as fix_input_sum'));
            },'records as fix_output' => function ($query) use ($params) {
                if(!empty($params['beginDate'])){
                    $query->where('operation_date','>=',$params['beginDate']);
                }
                if(!empty($params['endDate'])){
                    $query->where('operation_date','<=',$params['endDate']);
                }
                $query->where('operation_records.action', 'fix_output')->select(DB::raw('sum(operation_records.num) as fix_output_sum'));
            },

        ])->get();
        $productList->map(function($item){
            $item->fix_input = $item->fix_input?bcdiv($item->fix_input,100,2):0;
            $item->input = bcadd(($item->input?bcdiv($item->input,100,2):0),$item->fix_input,2);
            $item->fix_output = $item->fix_output?bcdiv($item->fix_output,100,2):0;
            $item->output = bcadd(($item->input?bcdiv($item->output,100,2):0),$item->fix_output,2);
            $item->storage = bcsub($item->input ,$item->output,2);
            return $item;
        });

        $list['productList'] = $productList;
        return $list;
    }


    public function categorySum()
    {
        $query = Category::query();
        $list = $query->select(['category_name','id'])->withCount([
            'records as input'=>function($query){
                $query->where('operation_records.action', 'input')->select(DB::raw('sum(operation_records.num) as input_sum'));
            },
            'records as output'=>function($query){
                $query->where('operation_records.action', 'output')->select(DB::raw('sum(operation_records.num) as output_sum'));
            },
            'records as fix_input'=>function($query){
                $query->where('operation_records.action', 'fix_input')->select(DB::raw('sum(operation_records.num) as fix_input_sum'));
            },
            'records as fix_output'=>function($query){
                $query->where('operation_records.action', 'fix_output')->select(DB::raw('sum(operation_records.num) as fix_output_sum'));
            },
        ])->get();
        $list->map(function($item){
            $item->fix_input = $item->fix_input?bcdiv($item->fix_input,100,2):0;
            $item->input = bcadd(($item->input?bcdiv($item->input,100,2):0),$item->fix_input,2);
            $item->fix_output = $item->fix_output?bcdiv($item->fix_output,100,2):0;
            $item->output = bcadd(($item->input?bcdiv($item->output,100,2):0),$item->fix_output,2);
            $item->storage = bcsub($item->input ,$item->output,2);
            $item->product_unit = '斤';
            unset($item->fix_input,$item->fix_output,$item->input,$item->output);
            return $item;
        });
        return $list;
    }
}
