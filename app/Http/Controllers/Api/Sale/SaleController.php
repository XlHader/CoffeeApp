<?php

namespace App\Http\Controllers\Api\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SaleStoreRequest;
use App\Services\SaleService;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->saleService->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleStoreRequest $request)
    {
        return $this->saleService->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->saleService->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        return $this->saleService->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        return $this->saleService->delete();
    }

    public function salesByProduct(int $productId)
    {
        return $this->saleService->salesByProduct($productId);
    }
}
