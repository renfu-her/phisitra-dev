@extends('layouts.app')

@section('title', '關於我們 - ' . config('app.name'))

@section('content')
@if($about['status'] ?? false)
<!--Page Title Area Start-->
<div class="page-title-area section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>關於我們</h3>
                        <p>了解我們的故事和使命</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Page Title Area-->

<!--About Area Start-->
<div class="about-area section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2>{{ $about['data']['title'] }}</h2>
                    <div class="about-text">
                        {!! $about['data']['content'] !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ Storage::url($about['data']['image']) }}" alt="關於我們" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of About Area-->

<!--Feature Area Start-->
<div class="feature-area section-padding section-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>我們的優勢</h3>
                        <p>為什麼選擇我們</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>專業團隊</h4>
                    <p>{{ $about['data']['team_description'] ?? '擁有豐富的教育經驗和專業知識，為學生提供最優質的服務。' }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4>國際視野</h4>
                    <p>{{ $about['data']['international_description'] ?? '與世界各地的優質學校合作，為學生開啟國際教育的大門。' }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>個性化服務</h4>
                    <p>{{ $about['data']['service_description'] ?? '根據每位學生的需求提供量身定制的教育規劃和建議。' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Feature Area-->
@else
<div class="container py-5">
    <div class="text-center">
        <h1 class="mb-4">關於我們</h1>
        <p class="lead">資料不存在</p>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
.page-title-area {
    padding: 60px 0;
    text-align: center;
}

.about-area {
    padding: 80px 0;
}

.about-content h2 {
    margin-bottom: 30px;
    color: #333;
}

.about-text {
    color: #666;
    line-height: 1.8;
}

.about-image img {
    width: 100%;
}

.feature-area {
    background: #f8f9fa;
    padding: 80px 0;
}

.single-feature {
    text-align: center;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.single-feature:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.feature-icon {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 20px;
}

.single-feature h4 {
    margin-bottom: 15px;
    color: #333;
}

.single-feature p {
    color: #666;
    margin-bottom: 0;
}

.section-gray {
    background: #f8f9fa;
}
</style>
@endpush 