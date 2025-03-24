@extends('layouts.app')

@section('title', $setting->meta_title ?? config('app.name'))

@section('content')
<!-- 輪播圖 -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/slider/slide1.jpg') }}" class="d-block w-100" alt="國際學生管理系統">
            <div class="carousel-caption">
                <h2>專業的國際學生管理系統</h2>
                <p>為您的學校提供完整的學生管理解決方案</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">立即諮詢</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slider/slide2.jpg') }}" class="d-block w-100" alt="多元文化">
            <div class="carousel-caption">
                <h2>多元文化學習環境</h2>
                <p>打造國際化的學習氛圍</p>
                <a href="{{ route('about') }}" class="btn btn-primary">了解更多</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slider/slide3.jpg') }}" class="d-block w-100" alt="專業服務">
            <div class="carousel-caption">
                <h2>全方位的專業服務</h2>
                <p>從入學到畢業，我們全程陪伴</p>
                <a href="{{ route('services') }}" class="btn btn-primary">查看服務</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- 特色服務 -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">我們的特色服務</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-user-graduate fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">學生管理</h3>
                        <p class="card-text">完整的學生資料管理系統，包括個人資料、學籍資料、成績記錄等。</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-book fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">課程管理</h3>
                        <p class="card-text">協助安排課程、管理課表、追蹤出席狀況，確保學習品質。</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-hands-helping fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">生活輔導</h3>
                        <p class="card-text">提供生活諮詢、心理輔導、文化適應等全方位支援服務。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 合作學校 -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">合作學校</h2>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <img src="{{ asset('images/schools/school1.png') }}" alt="合作學校" class="img-fluid mb-3" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <img src="{{ asset('images/schools/school2.png') }}" alt="合作學校" class="img-fluid mb-3" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <img src="{{ asset('images/schools/school3.png') }}" alt="合作學校" class="img-fluid mb-3" style="max-height: 80px;">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <img src="{{ asset('images/schools/school4.png') }}" alt="合作學校" class="img-fluid mb-3" style="max-height: 80px;">
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('schools') }}" class="btn btn-outline-primary">查看更多合作學校</a>
        </div>
    </div>
</section>

<!-- 聯絡我們 -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">需要協助？</h2>
                <p class="lead">我們提供專業的諮詢服務，協助您解決所有問題。</p>
                <p>無論是學校管理、學生服務，或是其他相關問題，我們都樂意為您提供協助。</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/contact.jpg') }}" alt="聯絡我們" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>
@endsection 