<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolHighlightResource;
use App\Models\SchoolHighlight;

class SchoolHighlightController extends Controller
{
    public function index()
    {
        $highlights = SchoolHighlight::orderBy('id')->get();
        
        if ($highlights->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No school highlights found',
                'data' => []
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved school highlights list',
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