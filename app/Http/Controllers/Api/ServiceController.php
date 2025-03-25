<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id')->get();
        
        if ($services->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No services found',
                'data' => []
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved services list',
            'data' => ServiceResource::collection($services)
        ]);
    }
    
    public function show(Service $service)
    {
        if (!$service) {
            return response()->json([
                'status' => false,
                'message' => 'Service not found',
                'data' => null
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved service details',
            'data' => new ServiceResource($service)
        ]);
    }
} 