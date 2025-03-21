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
        
        return response()->json([
            'success' => true,
            'message' => '成功取得服務項目列表',
            'data' => ServiceResource::collection($services)
        ]);
    }
    
    public function show(Service $service)
    {
        return response()->json([
            'success' => true,
            'message' => '成功取得服務項目詳情',
            'data' => new ServiceResource($service)
        ]);
    }
} 