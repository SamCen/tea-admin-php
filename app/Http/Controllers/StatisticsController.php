<?php

namespace App\Http\Controllers;

use App\Http\Requests\Statistics\SumStatisticsRequest;
use App\Models\Product;
use App\Services\StatisticsService;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function sumStatistics(SumStatisticsRequest $request, StatisticsService $statisticsService)
    {
        return success($statisticsService->sumStatistics($request->all()));
    }

    public function categorySum(SumStatisticsRequest $request, StatisticsService $statisticsService)
    {
        return success($statisticsService->categorySum());
    }
}
