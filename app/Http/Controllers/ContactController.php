<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 儲存到資料庫
        Contact::create($validated);

        // 發送郵件通知
        Mail::to(config('mail.from.address'))->send(new \App\Mail\ContactFormMail($validated));

        return redirect()->back()->with('success', '感謝您的訊息，我們會盡快回覆您！');
    }
} 