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

                    <!-- 聯絡表單 -->
                    <div class="mt-5">
                        <h2 class="h4 mb-4">聯絡表單</h2>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">姓名</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">電子郵件</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">主旨</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">訊息內容</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">送出訊息</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('meta')
<title>{{ $contact['data']['seo_title'] ?? '聯絡我們' }}</title>
<meta name="description" content="{{ $contact['data']['seo_description'] ?? '' }}">
<meta name="keywords" content="{{ $contact['data']['seo_keywords'] ?? '' }}">
@endsection 