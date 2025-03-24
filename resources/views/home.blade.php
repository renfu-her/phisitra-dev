@extends('layouts.app')

@section('title', $setting->meta_title ?? config('app.name'))

@section('content')
<!-- 輪播圖 -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($banners as $key => $banner)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($banners as $key => $banner)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" style="height: 450px;">
                <img src="{{ Storage::url($banner->image) }}" class="d-block w-100 h-100" alt="{{ $banner->title }}" style="object-fit: cover;">
                <div class="carousel-caption">
                    <h2>{{ $banner->title }}</h2>
                    @if($banner->description)
                        <p>{{ $banner->description }}</p>
                    @endif
                    @if($banner->button_text && $banner->button_link)
                        <a href="{{ $banner->button_link }}" class="btn btn-primary">{{ $banner->button_text }}</a>
                    @endif
                </div>
            </div>
        @endforeach
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