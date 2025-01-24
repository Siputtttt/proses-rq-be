<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Category::query();

            if ($request->input('n')) {
                $query->where('name', 'LIKE', '%' . $request->input('n') . '%');
            }

            $this->data['categories'] = $query->paginate(10);

            return ApiResponse::success($this->data, 'Categories retrieved successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 'Failed to retrieve categories', 500);
        }
    }

    public function store(Request $request)
    {
        switch ($request->input('action_task')) {
            case 'save_data':
                try {
                    $validated = $request->validate([
                        'name' => 'required|string|max:255',
                    ]);

                    if ($request->input('id')) {
                        $category = Category::find($request->input('id'));
                        $category->update($validated);
                    } else {
                        $category = Category::create([
                            'name' => $validated['name'],
                        ]);
                    }

                    return ApiResponse::success($category, 'Category saved successfully', 201);
                } catch (ValidationException $e) {
                    return ApiResponse::error($e->errors(), 'Validation failed', 422);
                } catch (\Exception $e) {
                    return ApiResponse::error(null, 'Failed to create category', 500);
                }
                break;
            case 'delete_data':
                try {
                    $category = Category::destroy($request->input('id'));

                    return ApiResponse::success(null, 'Category deleted successfully', 200);
                } catch (\Exception $e) {
                    return ApiResponse::error(null, 'Failed to delete category', 500);
                }
            default:
                return ApiResponse::error(null, 'Method not allowed', 405);
        }
    }
}
