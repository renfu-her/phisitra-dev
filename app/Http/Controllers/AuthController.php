<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('member')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => '電子郵件或密碼錯誤',
        ]);
    }

    public function register(Request $request)
    {
        $messages = [
            'name.required' => '請輸入姓名',
            'name.string' => '姓名必須是文字',
            'name.max' => '姓名不能超過 255 個字元',
            'email.required' => '請輸入電子郵件',
            'email.string' => '電子郵件必須是文字',
            'email.email' => '請輸入有效的電子郵件格式',
            'email.max' => '電子郵件不能超過 255 個字元',
            'email.unique' => '此電子郵件已被使用',
            'password.required' => '請輸入密碼',
            'password.string' => '密碼必須是文字',
            'password.min' => '密碼至少需要 8 個字元',
            'password.confirmed' => '密碼確認不符'
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        // 檢查是否已存在相同 email 且已啟用的會員
        $existingMember = Member::where('email', $validated['email'])
            ->where('is_active', 1)
            ->first();

        if ($existingMember) {
            return back()->withErrors([
                'email' => 'Email 已經是會員',
            ]);
        }

        $member = Member::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => false, // 預設為未啟用狀態
        ]);

        return redirect('/')->with('success', '註冊完成，請等待審核');
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 