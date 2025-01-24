<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Category;
use App\Models\News;
use Illuminate\Validation\ValidationException;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = News::query()->ORDERBY('date', 'DESC');

            if ($request->input('t')) {
                $query->where('title', 'LIKE', '%' . $request->input('t') . '%');
            }

            if ($request->input('c')) {
                $query->where('category', $request->input('c'));
            }

            $this->data['news'] = $query->paginate(10);
            $this->data['categoryOptions'] = Category::all();
            return ApiResponse::success($this->data, 'News retrieved successfully', 200);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 'Failed to retrieve News', 500);
        }
    }

    public function store(Request $request)
    {
        switch ($request->input('action_task')) {
            case 'save_data':
                try {
                    $validated = $request->validate([
                        'writer' => 'required|string|max:255',
                        'title' => 'required|string|max:255',
                        'abstract' => 'required|string|max:255',
                        'category' => 'required|string|max:255',
                        'date' => 'required|string|max:255',
                    ]);

                    if ($request->input('id')) {
                        $news = News::find($request->input('id'));
                        $news->update($validated);
                    } else {
                        $news = news::create([
                            'writer' => $validated['writer'],
                            'title' => $validated['title'],
                            'abstract' => $validated['abstract'],
                            'category' => $validated['category'],
                            'date' => $validated['date'],
                        ]);
                    }

                    return ApiResponse::success($news, 'News saved successfully', 201);
                } catch (ValidationException $e) {
                    return ApiResponse::error($e->errors(), 'Validation failed', 422);
                } catch (\Exception $e) {
                    return ApiResponse::error(null, 'Failed to create News', 500);
                }
                break;
            case 'delete_data':
                try {
                    $news = news::destroy($request->input('id'));

                    return ApiResponse::success(null, 'News deleted successfully', 200);
                } catch (\Exception $e) {
                    return ApiResponse::error(null, 'Failed to delete News', 500);
                }
            default:
                return ApiResponse::error(null, 'Method not allowed', 405);
        }
    }
}
