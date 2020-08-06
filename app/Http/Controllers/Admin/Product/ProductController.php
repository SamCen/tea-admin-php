<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductIndexRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request,ProductService $productService)
    {
        return success($productService->indexProduct($request->all()));
    }

    public function store(ProductStoreRequest $request,ProductService $productService)
    {
        return success($productService->storeProduct($request->all()));
    }

    public function show($product,ProductService $productService)
    {
        return success($productService->showProduct($product));
    }

    public function update(ProductUpdateRequest $request,Product $product,ProductService $productService)
    {
        return success($productService->saveProduct($product,$request->all()));
    }

    public function destroy(Product $product)
    {

    }

    public function unitList(Request $request,ProductService $productService)
    {
        return success($productService->unitList());
    }
}
