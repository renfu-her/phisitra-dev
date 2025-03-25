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
                    'image' => $service->image,
                ];
            })
        ]);
    }
} 