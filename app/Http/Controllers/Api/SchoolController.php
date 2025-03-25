<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::orderBy('id')->get();
        
        if ($schools->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No schools found',
                'data' => []
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved schools list',
            'data' => SchoolResource::collection($schools)
        ]);
    }
    
    public function show(School $school)
    {
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved school details',
            'data' => new SchoolResource($school)
        ]);
    }
} 