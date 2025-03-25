<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved services list',
            'data' => $services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'title' => $service->title,
                    'description' => $service->description,
                    'image' => $service->image ? Storage::url($service->image) : null,
                    'order' => $service->order,
                    'is_active' => $service->is_active,
                    'meta_title' => $service->meta_title,
                    'meta_description' => $service->meta_description,
                    'meta_keywords' => $service->meta_keywords,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                ];
            })
        ]);
    }
} 