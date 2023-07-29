<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->categoryService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        return $this->categoryService->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->categoryService->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, int $id)
    {
        return $this->categoryService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->categoryService->delete($id);
    }
}
