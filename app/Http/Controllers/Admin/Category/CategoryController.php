<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryIndexRequest;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryIndexRequest $request,CategoryService $categoryService)
    {
        return success($categoryService->indexCategory($request->all()));
    }

    public function store(CategoryStoreRequest $request,CategoryService $categoryService)
    {
        return success($categoryService->storeCategory($request->all()));
    }

    public function update(CategoryUpdateRequest $request,Category $category,CategoryService $categoryService)
    {
        return success($categoryService->saveCategory($category,$request->all()));
    }

    public function show($category,CategoryService $categoryService)
    {
        return success($categoryService->showCategory($category));
    }

    public function destroy(Category $category)
    {

    }

    public function allList(Request $request,CategoryService $categoryService)
    {
        return success($categoryService->allList());
    }
}
