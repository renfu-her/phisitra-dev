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
                    <div class="d-flex flex-column gap-4">
                        <!-- 營業時間 -->
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fa-regular fa-clock fa-lg text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">營業時間</div>
                                <div>週一至週五 9:00-18:00</div>
                            </div>
                        </div>

                        <!-- 地址 -->
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fa-solid fa-location-dot fa-lg text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">地址</div>
                                <div>{{ $contact['data']['address'] }}</div>
                            </div>
                        </div>

                        <!-- 電話 -->
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fa-solid fa-phone fa-lg text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">電話</div>
                                <div>{{ $contact['data']['phone'] }}</div>
                            </div>
                        </div>

                        <!-- 傳真 -->
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fa-solid fa-fax fa-lg text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">傳真</div>
                                <div>{{ $contact['data']['fax'] }}</div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fa-regular fa-envelope fa-lg text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Email</div>
                                <div>{{ $contact['data']['email'] }}</div>
                            </div>
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