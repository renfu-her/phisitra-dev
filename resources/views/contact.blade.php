@extends('layouts.app')

@section('title', '聯絡我們 - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- 公司名稱 -->
            <div class="mb-8 pb-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">{{ $contact['data']['name_zh'] }}</h1>
                <p class="text-gray-600 mt-1">{{ $contact['data']['name_en'] }}</p>
            </div>

            <!-- 聯絡資訊 -->
            <div class="space-y-4">
                <!-- 營業時間 -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>營業時間</span>
                    </div>
                    <div class="text-gray-700">週一至週五 9:00-18:00</div>
                </div>

                <!-- 地址 -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>地址</span>
                    </div>
                    <div class="text-gray-700">{{ $contact['data']['address'] }}</div>
                </div>

                <!-- 電話 -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>電話</span>
                    </div>
                    <div class="text-gray-700">{{ $contact['data']['phone'] }}</div>
                </div>

                <!-- 傳真 -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        <span>傳真</span>
                    </div>
                    <div class="text-gray-700">{{ $contact['data']['fax'] }}</div>
                </div>

                <!-- Email -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Email</span>
                    </div>
                    <div class="text-gray-700">{{ $contact['data']['email'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('meta')
<title>{{ $contact['data']['seo_title'] ?? '聯絡我們' }}</title>
<meta name="description" content="{{ $contact['data']['seo_description'] }}">
<meta name="keywords" content="{{ $contact['data']['seo_keywords'] }}">
@endsection 