<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        
        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => '找不到關於我們的資料',
                'data' => null
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => '成功取得關於我們的資料',
            'data' => new AboutResource($about)
        ]);
    }
} 