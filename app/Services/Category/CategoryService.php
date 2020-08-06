<?php

namespace App\Services\Category;

use App\Exceptions\GeneralException;
use App\Models\Category;
use Carbon\Carbon;

class CategoryService
{
    /**
     * Author Cjc
     * DateTime 2020/8/4 8:12 下午
     * Description:添加分类
     * @param $params
     * @return Category
     */
    public function storeCategory($params)
    {
        $category = new Category();
        $category->fill($params);
        $category->save();
        return $category;
    }

    /**
     * Author Cjc
     * DateTime 2020/8/5 11:45 上午
     * Description:更新分类
     * @param Category $category
     * @param $params
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function saveCategory(Category $category,$params)
    {
        $category->fill($params);
        $category->save();
        return $category;
    }

    /**
     * Author Cjc
     * DateTime 2020/8/4 8:17 下午
     * Description:获取分类分页列表
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function indexCategory($params)
    {
        $page = !empty($params['page'])?$params['page']:1;
        $limit = !empty($params['limit'])?$params['limit']:10;
        $list = Category::query()->paginate($limit,['*'],'page',$page);
        return $list;
    }


    public function showCategory($categoryId)
    {
        return Category::query()->find($categoryId);
    }

    public function allList()
    {
        return Category::query()->get();
    }
}
