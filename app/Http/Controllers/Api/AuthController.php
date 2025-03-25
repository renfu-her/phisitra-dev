<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // 將用戶資訊存入 session
            session([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => '登入成功'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => '帳號或密碼錯誤'
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('user');

        return response()->json([
            'success' => true,
            'message' => '登出成功'
        ]);
    }
} 