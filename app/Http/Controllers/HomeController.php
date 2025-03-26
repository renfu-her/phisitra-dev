<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Banner;
use App\Models\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    protected $apiUrl = 'https://phisitra.dev-vue.com/api/v1';

    public function index()
    {
        $setting = Setting::first();
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $aboutResponse = Http::withoutVerifying()->get($this->apiUrl . '/about');
        $about = $aboutResponse->json();
        
        $schoolsResponse = Http::withoutVerifying()->get($this->apiUrl . '/schools');
        $schoolsData = $schoolsResponse->json();
        $schools = collect($schoolsData['data'] ?? [])->take(4);

        $homeServicesResponse = Http::withoutVerifying()->get($this->apiUrl . '/home-services');
        $homeServicesData = $homeServicesResponse->json();
        $homeServices = $homeServicesData['data'] ?? [];

        return view('home', compact('setting', 'about', 'banners', 'schools', 'homeServices'));
    }

    public function about()
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/about');
        $about = $response->json();

        return view('about', compact('about'));
    }

    public function contact()
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/contact');
        $contact = $response->json();
        
        return view('contact', compact('contact'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $response = Http::withoutVerifying()
            ->post($this->apiUrl . '/contact', $validated);

        if ($response->successful()) {
            return back()->with('success', '訊息已成功發送！');
        }

        return back()->with('error', '發送失敗，請稍後再試。');
    }

    public function services()
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/services');
        $services = $response->json();
        return view('services', compact('services'));
    }
} 