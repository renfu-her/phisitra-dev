<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SchoolController extends Controller
{
    public function index()
    {
        $response = Http::withoutVerifying()->get(route('api.v1.schools'));
        $schools = $response->json();
        return view('schools.index', compact('schools'));
    }

    public function gallery()
    {
        $response = Http::withoutVerifying()->get(route('api.v1.highlights'));
        $galleries = $response->json();
        return view('schools.gallery', compact('galleries'));
    }
} 