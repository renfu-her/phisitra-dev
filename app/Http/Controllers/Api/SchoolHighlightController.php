<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolHighlightResource;
use App\Models\SchoolHighlight;

class SchoolHighlightController extends Controller
{
    public function index()
    {
        $highlights = SchoolHighlight::orderBy('sort_order')->get();
        
        return response()->json([
            'success' => true,
            'message' => '成功取得合作花絮列表',
            'data' => SchoolHighlightResource::collection($highlights)
        ]);
    }
    
    public function show(SchoolHighlight $highlight)
    {
        return response()->json([
            'success' => true,
            'message' => '成功取得合作花絮詳情',
            'data' => new SchoolHighlightResource($highlight)
        ]);
    }
} 