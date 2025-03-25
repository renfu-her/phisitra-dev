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
                    <div class="d-flex flex-column gap-3">
                        <!-- 營業時間 -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center" style="width: 120px;">
                                <i class="bi bi-clock me-2"></i>
                                <span>營業時間</span>
                            </div>
                            <div>週一至週五 9:00-18:00</div>
                        </div>

                        <!-- 地址 -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center" style="width: 120px;">
                                <i class="bi bi-geo-alt me-2"></i>
                                <span>地址</span>
                            </div>
                            <div>{{ $contact['data']['address'] }}</div>
                        </div>

                        <!-- 電話 -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center" style="width: 120px;">
                                <i class="bi bi-telephone me-2"></i>
                                <span>電話</span>
                            </div>
                            <div>{{ $contact['data']['phone'] }}</div>
                        </div>

                        <!-- 傳真 -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center" style="width: 120px;">
                                <i class="bi bi-printer me-2"></i>
                                <span>傳真</span>
                            </div>
                            <div>{{ $contact['data']['fax'] }}</div>
                        </div>

                        <!-- Email -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center" style="width: 120px;">
                                <i class="bi bi-envelope me-2"></i>
                                <span>Email</span>
                            </div>
                            <div>{{ $contact['data']['email'] }}</div>
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