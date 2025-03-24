<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $response = Http::withoutVerifying()->get(route('api.v1.about'));
        $about = $response->json();
        return view('home', compact('setting', 'about'));
    }

    public function about()
    {
        $response = Http::withoutVerifying()->get(route('api.v1.about'));
        $about = $response->json();
        return view('about', compact('about'));
    }

    public function contact()
    {
        $response = Http::withoutVerifying()->get(route('api.v1.contact'));
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

        $response = Http::withoutVerifying()->post(route('api.v1.contact.send'), $validated);

        if ($response->successful()) {
            return back()->with('success', '訊息已成功發送！');
        }

        return back()->with('error', '發送失敗，請稍後再試。');
    }

    public function services()
    {
        $response = Http::withoutVerifying()->get(route('api.v1.services'));
        $services = $response->json();
        return view('services', compact('services'));
    }
} 