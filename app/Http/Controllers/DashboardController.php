<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\ApiResponse;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = [
            'tahun' => $request->input('t')? $request->input('t') : "",
        ];
        $this->data['total_date'] = Dashboard::getSummaryDate();
        $this->data['total_categegory'] = Dashboard::getSummaryCategory($search['tahun']);
        $this->data['total_writter'] = Dashboard::getSummaryWritter($search['tahun']);

        return ApiResponse::success($this->data, 'News retrieved successfully', 200);
    }
}
