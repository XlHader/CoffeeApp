<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        return $this->productService->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->productService->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, int $id)
    {
        return $this->productService->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->productService->delete($id);
    }
}
