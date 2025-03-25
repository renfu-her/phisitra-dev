@extends('layouts.app')

@section('title', '聯絡我們 - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">聯絡我們</h1>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold mb-2">{{ $contact->name_zh }}</h2>
                <p class="text-gray-600 mb-4">{{ $contact->name_en }}</p>
            </div>

            <div class="space-y-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-gray-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">地址</h3>
                        <p class="text-gray-600">{{ $contact->address }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="w-6 h-6 text-gray-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">電話</h3>
                        <p class="text-gray-600">{{ $contact->phone }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="w-6 h-6 text-gray-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">傳真</h3>
                        <p class="text-gray-600">{{ $contact->fax }}</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <svg class="w-6 h-6 text-gray-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Email</h3>
                        <p class="text-gray-600">{{ $contact->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('meta')
<title>{{ $contact->seo_title ?? '聯絡我們' }}</title>
<meta name="description" content="{{ $contact->seo_description }}">
<meta name="keywords" content="{{ $contact->seo_keywords }}">
@endsection 