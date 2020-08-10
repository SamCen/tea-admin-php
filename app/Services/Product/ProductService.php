<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductService
{
    /**
     * Author Cjc
     * DateTime 2020/8/5 11:32 上午
     * Description:创建产品科目
     * @param $params
     * @return Product
     */
    public function storeProduct($params)
    {
        $product = new Product();
        $product->fill($params);
        $product->save();
        return $product;
    }

    /**
     * Author Cjc
     * DateTime 2020/8/5 11:40 上午
     * Description:更新产品科目
     * @param Product $product
     * @param $params
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function saveProduct(Product $product,$params)
    {
        $product->fill($params);
        $product->save();
        return $product;
    }

    /**
     * Author Cjc
     * DateTime 2020/8/5 11:42 上午
     * Description:产品科目分页列表
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function indexProduct($params)
    {
        $page = !empty($params['page'])?$params['page']:1;
        $limit = !empty($params['limit'])?$params['limit']:10;
        $query = Product::query();
        if(!empty($params['product_name'])){
            $query->where('product_name','like',"%{$params['product_name']}%");
        }
        $list = $query->with('category')->paginate($limit,['*'],'page',$page);
        return $list;
    }

    /**
     * Author Cjc
     * DateTime 2020/8/5 8:21 下午
     * Description:获取单个product
     * @param $productId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function showProduct($productId)
    {
        return Product::query()->with('category')->find($productId);
    }

    /**
     * Author Cjc
     * DateTime 2020/8/5 11:43 上午
     * Description:删除科目
     * @param $productId
     * @return int
     */
    public function destroyProduct($productId)
    {
        return Product::destroy($productId);
    }

    public function unitList()
    {
        return Product::UNIT_LIST;
    }

    /**
     * Author Cjc
     * DateTime 2020/8/7 4:14 下午
     * Description:产品下拉列表
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function productSelectList()
    {
        return Product::query()->select(['id','product_name as text','product_unit as unit'])->get();
    }
}
