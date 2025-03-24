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
            'message' => 'Successfully retrieved highlights list',
            'data' => SchoolHighlightResource::collection($highlights)
        ]);
    }
    
    public function show(SchoolHighlight $highlight)
    {
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved highlight details',
            'data' => new SchoolHighlightResource($highlight)
        ]);
    }
} 