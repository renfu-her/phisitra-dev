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
        return view('home', compact('setting'));
    }

    public function about()
    {
        $response = Http::get(route('api.v1.about'));
        $about = $response->json();
        return view('about', compact('about'));
    }

    public function contact()
    {
        $response = Http::get(route('api.v1.contact'));
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

        // TODO: 實作寄信功能
        // Mail::to(config('mail.from.address'))->send(new ContactFormMail($validated));

        return redirect()->back()->with('success', '訊息已成功送出，我們會盡快與您聯繫！');
    }

    public function services()
    {
        $response = Http::get(route('api.v1.services'));
        $services = $response->json();
        return view('services', compact('services'));
    }
} 