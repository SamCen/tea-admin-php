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
        $categoryQuery = Category::query();
        $categoryList = $categoryQuery->select(['id','category_name'])->get();
        $productList->map(function($item){
            $item->input = bcadd(($item->input?bcdiv($item->input,100,2):0),($item->fix_input?bcdiv($item->fix_input,100,2):0));
            $item->output = bcadd(($item->input?bcdiv($item->output,100,2):0),($item->fix_output?bcdiv($item->fix_output,100,2):0));
            $item->storage = bcdiv(($item->input - $item->output),1,2);
            return $item;
        });
        foreach ($categoryList as $index => $category){
            foreach ($productList as $product){
                if($product->category_id == $category->id){
                    $categoryList[$index]->input += $product->input;
                    $categoryList[$index]->output += $product->output;
                    $categoryList[$index]->storage += $product->storage;
                }
            }
        }
        $list['categoryList'] = $categoryList;
        $list['productList'] = $productList;
        return $list;
    }
}
