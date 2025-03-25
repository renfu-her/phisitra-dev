@extends('layouts.app')

@section('title', '聯絡我們 - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">聯絡我們</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="mb-6 text-center">
                <h2 class="text-xl font-semibold mb-1">{{ $contact['data']['name_zh'] }}</h2>
                <p class="text-gray-600 text-sm">{{ $contact['data']['name_en'] }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-gray-700 font-medium mb-2">地址</h3>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-gray-600 text-sm">{{ $contact['data']['address'] }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-700 font-medium mb-2">電話</h3>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <p class="text-gray-600 text-sm">{{ $contact['data']['phone'] }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-700 font-medium mb-2">傳真</h3>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        <p class="text-gray-600 text-sm">{{ $contact['data']['fax'] }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-gray-700 font-medium mb-2">Email</h3>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-600 text-sm">{{ $contact['data']['email'] }}</p>
                    </div>
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