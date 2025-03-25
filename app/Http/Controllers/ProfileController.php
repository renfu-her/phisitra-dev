<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $apiUrl = 'https://phisitra.dev-vue.com/api/v1';

    public function index()
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/members');
        $members = $response->json();
        return view('profile', compact('members'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'phone']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $response = Http::withoutVerifying()
            ->put($this->apiUrl . '/members', $data);

        if ($response->successful()) {
            return redirect()->route('profile')->with('success', '個人資料已更新');
        }

        return back()->with('error', '更新失敗，請稍後再試');
    }
} 