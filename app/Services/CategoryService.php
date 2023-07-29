<?php

namespace App\Services;

use App\Exceptions\CategoryException;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class CategoryService
{
    /**
     * Return a category by id.
     * @param int $id Category id
     * @throws CategoryException Category not found
     */
    public function find(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json(new CategoryResource($category));
        } catch (\Exception $e) {
            throw new CategoryException($e, 'Category not found.', 404);
        }
    }

    /**
     * Return all categories.
     * @throws CategoryException Error getting categories
     */
    public function all(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(new CategoryCollection(Category::all()));
        } catch (\Exception $e) {
            throw new CategoryException($e, 'Error getting categories.', 500);
        }
    }

    /**
     * Create a new category.
     * @param array $data Category data
     * @throws CategoryException Error creating category
     */
    public function create(array $data): \Illuminate\Http\JsonResponse
    {
        try {
            $category = Category::where('name', $data['name'])->first();

            if ($category) {
                return response()->json([
                    'message' => 'Category already exists.',
                    'error' => true
                ], 422);
            }

            $category = Category::create($data);

            return response()->json(new CategoryResource($category));
        } catch (\Exception $e) {
            throw new CategoryException($e, 'Error creating category.', 500);
        }
    }

    /**
     * Update a category.
     * @param array $data Category data
     * @param int $id Category id
     * @throws CategoryException Error updating category
     */
    public function update(array $data, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category not found.',
                    'error' => true
                ], 404);
            }

            $category->update($data);

            return response()->json(new CategoryResource($category));
        } catch (\Exception $e) {
            throw new CategoryException($e, 'Error updating category.', 500);
        }
    }

    /**
     * Delete a category.
     * @param int $id Category id
     * @throws CategoryException Error deleting category
     */
    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $category = Category::find($id);


            if (!$category) {
                return response()->json([
                    'message' => 'Category not found.',
                    'error' => true
                ], 404);
            }

            if ($category?->products()?->count() > 0) {
                return response()->json([
                    'message' => 'Category has products.',
                    'error' => true
                ], 422);
            }

            $category->delete();

            return response()->json([
                'message' => 'Category deleted successfully.',
                'error' => false
            ]);
        } catch (\Exception $e) {
            throw new CategoryException($e, 'Error deleting category.', 500);
        }
    }
}
