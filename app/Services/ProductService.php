<?php

namespace App\Services;

use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use App\Exceptions\ProductException;
use App\Http\Resources\Product\ProductResource;

class ProductService
{
    /**
     * Return a product by id.
     * @param int $id Product id
     * @throws ProductException Product not found
     * @return \Illuminate\Http\JsonResponse Product data
     */
    public function find(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(new ProductResource($product));
        } catch (\Exception $e) {
            throw new ProductException($e, 'Product not found.', 404);
        }
    }

    /**
     * Return all products.
     * @throws ProductException Error getting products
     * @return \Illuminate\Http\JsonResponse Products data
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(new ProductCollection(Product::all()));
        } catch (\Exception $e) {
            throw new ProductException($e, 'Error getting products.', 500);
        }
    }

    /**
     * Create a new product.
     * @param array $data Product data
     * @throws ProductException Error creating product
     * @return \Illuminate\Http\JsonResponse Product data
     */
    public function create(array $data): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::create($data);
            return response()->json(new ProductResource($product));
        } catch (\Exception $e) {
            throw new ProductException($e, 'Error creating product.', 500);
        }
    }

    /**
     * Update a product.
     * @param array $data Product data
     * @param int $id Product id
     * @throws ProductException Error updating product
     * @return \Illuminate\Http\JsonResponse Product data
     */
    public function update(array $data, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found.',
                    'error' => true
                ], 404);
            }

            $product->update($data);
            return response()->json(new ProductResource($product));
        } catch (\Exception $e) {
            throw new ProductException($e, 'Error updating product.', 500);
        }
    }

    /**
     * Delete a product.
     * @param int $id Product id
     * @throws ProductException Error deleting product
     * @return \Illuminate\Http\JsonResponse Success message
     */
    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully.',
                'error' => false
            ]);
        } catch (\Exception $e) {
            throw new ProductException($e, 'Error deleting product.', 500);
        }
    }
}
