<?php

namespace App\Http\Controllers;

use App\Http\Requests\Statistics\SumStatisticsRequest;
use App\Models\Product;
use App\Services\StatisticsService;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function sumStatistics(SumStatisticsRequest $request,StatisticsService $statisticsService)
    {
        $list = Product::query()->withCount([
            'records as input'=>function($query){
                $query->where('operation_records.action','input')->select(DB::raw('sum(operation_records.num) as input_sum'));
            },['records as output'=>function($query){
                $query->where('operation_records.action','output')->select(DB::raw('sum(operation_records.num) as input_sum'));
            }]
        ])->get();
        return $list;
    }
}
