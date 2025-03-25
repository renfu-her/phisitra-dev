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
                'status' => false,
                'message' => 'About information not found',
                'data' => null
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved about information',
            'data' => new AboutResource($about)
        ]);
    }
} 