@extends('layouts.app')

@section('title', '聯絡我們 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- 公司名稱 -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h1 class="h3">{{ $contact['data']['name_zh'] }}</h1>
                        <p class="text-muted">{{ $contact['data']['name_en'] }}</p>
                    </div>

                    <!-- 聯絡資訊 -->
                    <div class="row row-cols-2 g-4"></div>
                        <!-- 營業時間 -->
                        <div class="col text-center">
                            <div class="mb-2">
                                <i class="bi bi-clock fs-3"></i>
                            </div>
                            <div class="fw-bold fs-5 mb-1">營業時間</div>
                            <div class="fs-6">週一至週五<br>9:00-18:00</div>
                        </div>

                        <!-- 地址 -->
                        <div class="col text-center">
                            <div class="mb-2">
                                <i class="bi bi-geo-alt fs-3"></i>
                            </div>
                            <div class="fw-bold fs-5 mb-1">地址</div>
                            <div class="fs-6">{{ $contact['data']['address'] }}</div>
                        </div>

                        <!-- 電話 -->
                        <div class="col text-center">
                            <div class="mb-2">
                                <i class="bi bi-telephone fs-3"></i>
                            </div>
                            <div class="fw-bold fs-5 mb-1">電話</div>
                            <div class="fs-6">{{ $contact['data']['phone'] }}</div>
                        </div>

                        <!-- 傳真 -->
                        <div class="col text-center">
                            <div class="mb-2">
                                <i class="bi bi-printer fs-3"></i>
                            </div>
                            <div class="fw-bold fs-5 mb-1">傳真</div>
                            <div class="fs-6">{{ $contact['data']['fax'] }}</div>
                        </div>

                        <!-- Email -->
                        <div class="col text-center">
                            <div class="mb-2">
                                <i class="bi bi-envelope fs-3"></i>
                            </div>
                            <div class="fw-bold fs-5 mb-1">Email</div>
                            <div class="fs-6">{{ $contact['data']['email'] }}</div>
                        </div>
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