<?php

namespace App\Services;

use App\Exceptions\SaleException;
use App\Http\Resources\Sale\SaleCollection;
use App\Http\Resources\Sale\SaleResource;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class SaleService
{



    private function invalidStock(Product $product, int $amount): bool
    {
        return $product->stock < $amount;
    }

    /**
     * Return a sale by id.
     * @param int $id Sale id
     * @throws SaleException Sale not found
     * @return \Illuminate\Http\JsonResponse Sale data
     */
    public function find(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $sale = Sale::findOrFail($id);
            return response()->json(new SaleResource($sale));
        } catch (\Exception $e) {
            throw new SaleException($e, 'Sale not found.', 404);
        }
    }

    /**
     * Return all sales.
     * @throws SaleException Sales not found
     * @return \Illuminate\Http\JsonResponse Sales data
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        try {
            $sales = Sale::all();
            return response()->json(SaleResource::collection($sales));
        } catch (\Exception $e) {
            throw new SaleException($e, 'Sales not found.', 404);
        }
    }

    /**
     * Create a new sale.
     * @param array $data Sale data
     * @throws SaleException Error creating sale
     * @return \Illuminate\Http\JsonResponse Sale data
     */
    public function create(array $data): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::findOrFail($data['product_id']);

            if ($this->invalidStock($product, $data['amount'])) {
                return response()->json([
                    "message" => "Invalid stock, can't sell more than available",
                    "error" => true
                ], 400);
            }

            $user = auth()->user();

            $sale = Sale::create([
                'product_id' => $product->id,
                'amount' => $data['amount'],
                'seller_id' => $user->id,
                'total' => $product->price * $data['amount']
            ]);

            return response()->json(new SaleResource($sale));
        } catch (\Exception $e) {
            throw new SaleException($e, 'Error creating sell', 500);
        }
    }

    /**
     * Update a sale. Method not allowed. Can't update a sale.
     * @param array $data Sale data
     * @param int $id Sale id
     * @throws SaleException Error updating sale
     * @return \Illuminate\Http\JsonResponse Sale data
     */
    public function update(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Can't update a sale",
            "error" => true
        ], 403);
    }

    /**
     * Method not allowed. Can't delete a sale.
     * @param int $id Sale id
     * @return \Illuminate\Http\JsonResponse Sale data
     */
    public function delete(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Can't delete a sale",
            "error" => true
        ], 403);
    }

    /**
     * Return all sales by a product.
     * @param int $productId Product id
     * @throws SaleException Sales not found
     * @return \Illuminate\Http\JsonResponse Sales data
     * @throws SaleException Sales not found
     */
    public function salesByProduct(int $productId): \Illuminate\Http\JsonResponse
    {
        try {
            $sales = Sale::where('product_id', $productId)->get();
            return response()->json(new SaleCollection($sales));
        } catch (\Exception $e) {
            throw new SaleException($e, 'Sales not found.', 404);
        }
    }
}
