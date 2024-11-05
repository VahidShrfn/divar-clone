<?php

namespace App\Http\Controllers;

use App\Services\SettingServices\CategoryService;
use Illuminate\Http\Request;

class SettingCategoryController extends Controller
{
    public function get()
    {
        $categories = CategoryService::make()
            ->get();
        return response()
            ->json([
                'data' => $categories,
                'message' => 'successful'
            ]);
    }
}
