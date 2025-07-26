<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\category_layanan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ApiCategoryLayananController extends Controller
{
    /**
     * Get all categories layanan.
     */
    public function index()
    {
        try {
            $categories = category_layanan::all();
            return response()->json([
                'statusCode' => 200,
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'statusCode' => 500,
                'message' => 'Failed to retrieve categories',
                'data' => null
            ], 500);
        }
    }

    /**
     * Get a single category layanan by UUID.
     */
    public function show($uuid)
    {
        try {
            $category = category_layanan::where('uuid', $uuid)->first();

            if (!$category) {
                return response()->json([
                    'statusCode' => 404,
                    'message' => 'Category not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'statusCode' => 200,
                'message' => 'Category retrieved successfully',
                'data' => $category
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'statusCode' => 500,
                'message' => 'Failed to retrieve category',
                'data' => null
            ], 500);
        }
    }

    /**
     * Create a new category layanan.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'description' => 'required|string',
                'treatment_type' => 'required|string',
            ]);

            // Create category
            $category = category_layanan::create([
                'description' => $validated['description'],
                'treatment_type' => $validated['treatment_type'],
            ]);

            return response()->json([
                'statusCode' => 201,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'statusCode' => 500,
                'message' => 'Failed to create category',
                'data' => null
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'Invalid input or request',
                'data' => null
            ], 400);
        }
    }

    /**
     * Update an existing category layanan.
     */
    public function update(Request $request, $uuid)
    {
        try {
            // Find the category by UUID
            $category = category_layanan::where('uuid', $uuid)->first();

            if (!$category) {
                return response()->json([
                    'statusCode' => 404,
                    'message' => 'Category not found',
                    'data' => null
                ], 404);
            }

            // Validate the request
            $validated = $request->validate([
                'description' => 'required|string',
                'treatment_type' => 'required|string',
            ]);

            // Update the category
            $category->update([
                'description' => $validated['description'],
                'treatment_type' => $validated['treatment_type'],
            ]);

            return response()->json([
                'statusCode' => 200,
                'message' => 'Category updated successfully',
                'data' => $category
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'statusCode' => 500,
                'message' => 'Failed to update category',
                'data' => null
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'Invalid input or request',
                'data' => null
            ], 400);
        }
    }

    /**
     * Delete a category layanan.
     */
    public function destroy($uuid)
    {
        try {
            // Find the category by UUID
            $category = category_layanan::where('uuid', $uuid)->first();

            if (!$category) {
                return response()->json([
                    'statusCode' => 404,
                    'message' => 'Category not found',
                    'data' => null
                ], 404);
            }

            // Delete the category
            $category->delete();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Category deleted successfully',
                'data' => null
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'statusCode' => 500,
                'message' => 'Failed to delete category',
                'data' => null
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'An error occurred while processing the request',
                'data' => null
            ], 400);
        }
    }
}
