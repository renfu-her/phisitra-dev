<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SchoolController extends Controller
{
    protected $apiUrl = 'https://phisitra.dev-vue.com/api/v1';

    public function index()
    {
        $schoolsResponse = Http::withoutVerifying()->get($this->apiUrl . '/schools');
        $schools = $schoolsResponse->json();

        $highlightsResponse = Http::withoutVerifying()->get($this->apiUrl . '/highlights');
        $highlights = $highlightsResponse->json();

        return view('schools.index', compact('schools', 'highlights'));
    }

    public function gallery()
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/highlights');
        $galleries = $response->json();
        return view('schools.gallery', compact('galleries'));
    }

    public function show($id)
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/schools/' . $id);
        $school = $response->json();
        
        if (!$school) {
            abort(404);
        }
        
        return view('schools.show', compact('school'));
    }
} 