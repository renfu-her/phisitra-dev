<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HomeServiceController extends Controller
{
    /**
     * 獲取所有首頁服務
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $services = HomeService::query()
            ->orderBy('sort')
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'icon' => $service->icon,
                    'title' => $service->title,
                    'sub_title' => $service->sub_title,
                    'is_active' => $service->is_active,
                    'sort' => $service->sort,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at
                ];
            });

        return response()->json([
            'success' => !$services->isEmpty(),
            'message' => $services->isEmpty() 
                ? 'No home services found' 
                : 'Successfully retrieved home services',
            'data' => $services
        ]);
    }

    /**
     * 獲取單個首頁服務
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $service = HomeService::findOrFail($id);

        $data = [
            'id' => $service->id,
            'icon' => $service->icon,
            'title' => $service->title,
            'sub_title' => $service->sub_title,
            'is_active' => $service->is_active,
            'sort' => $service->sort,
            'created_at' => $service->created_at,
            'updated_at' => $service->updated_at
        ];

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved home service',
            'data' => $data
        ]);
    }
}
