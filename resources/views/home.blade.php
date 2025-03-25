@extends('layouts.app')

@section('title', $setting->meta_title ?? config('app.name'))

@section('content')
<!--Slider Area Start-->
<div class="slider-area">
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banners as $key => $banner)
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($banners as $key => $banner)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                    <div class="banner-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-md-7">
                                    <div class="text-content">
                                        <h1 class="title1">{{ $banner->title }}</h1>
                                        @if($banner->description)
                                            <p class="sub-title">{{ $banner->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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
</div>
<!--End of Slider Area-->

<!--Activity Area Start-->
<div class="activity-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 activity">
                <div class="single-activity">
                    <div class="single-activity-icon">
                        <i class="fa fa-user-graduate"></i>
                    </div>
                    <h4>學生管理</h4>
                    <p>完整的學生資料管理系統，包括個人資料、學籍資料、成績記錄等。</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 activity">
                <div class="single-activity">
                    <div class="single-activity-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <h4>課程管理</h4>
                    <p>協助安排課程、管理課表、追蹤出席狀況，確保學習品質。</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 activity">
                <div class="single-activity mrg-res-top-md">
                    <div class="single-activity-icon">
                        <i class="fa fa-hands-helping"></i>
                    </div>
                    <h4>生活輔導</h4>
                    <p>提供生活諮詢、心理輔導、文化適應等全方位支援服務。</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 activity">
                <div class="single-activity mrg-res-top-md">
                    <div class="single-activity-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <h4>國際交流</h4>
                    <p>促進國際文化交流，擴展學生視野，提供多元學習機會。</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Activity Area-->

<!--Class Area Start-->
<div class="class-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>合作學校</h3>
                        <p>我們的合作夥伴</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @forelse($schools as $school)
                <div class="col-md-3 col-sm-6">
                    <div class="single-class">
                        <div class="single-class-image">
                            <a href="{{ route('schools.show', $school['id'] ?? '') }}">
                                <img src="{{ $school['logo'] ? Storage::url($school['logo']) : asset('images/no-image.png') }}" 
                                     alt="{{ $school['name'] ?? '未命名學校' }}" 
                                     class="img-fluid">
                            </a>
                        </div>
                        <div class="single-class-text">
                            <h4>
                                <a href="{{ route('schools.show', $school['id'] ?? '') }}">
                                    {{ $school['name'] ?? '未命名學校' }}
                                </a>
                            </h4>
                            @if(!empty($school['location']))
                                <p><i class="fas fa-map-marker-alt"></i> {{ $school['location'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>目前沒有合作學校資料</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('schools') }}" class="button-default">查看更多合作學校</a>
        </div>
    </div>
</div>
<!--End of Class Area-->

<!--Contact Area Start-->
<div class="newsletter-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-info">
                    <h2>需要協助？</h2>
                    <p class="lead">我們提供專業的諮詢服務，協助您解決所有問題。</p>
                    <p>無論是學校管理、學生服務，或是其他相關問題，我們都樂意為您提供協助。</p>
                    <a href="{{ route('contact') }}" class="button-default">聯絡我們</a>
                </div>
            </div>
            <div class="col-lg-6">
                <form class="newsletter-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>立即諮詢</h4>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="name" placeholder="您的姓名">
                            <input type="email" name="email" placeholder="電子郵件">
                            <input type="text" name="subject" placeholder="主旨">
                        </div>
                        <div class="col-lg-6">
                            <textarea name="message" placeholder="您的訊息"></textarea>
                            <button type="submit" class="button-default">送出</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of Contact Area-->
@endsection

@push('styles')
<style>
.slider-area {
    position: relative;
}

.slider-area .carousel-item {
    height: 450px;
}

.slider-area .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-content {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.banner-content .title1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.banner-content .sub-title {
    font-size: 18px;
    line-height: 1.6;
}

.activity-area {
    padding: 80px 0;
    background: #f8f9fa;
}

.single-activity {
    text-align: center;
    padding: 30px 20px;
    background: #fff;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.single-activity:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.single-activity-icon {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 20px;
}

.button-default {
    display: inline-block;
    padding: 12px 30px;
    background: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.button-default:hover {
    background: #0056b3;
    color: #fff;
}

.newsletter-area {
    padding: 80px 0;
    background: #f8f9fa;
}

.newsletter-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
}

.newsletter-container input,
.newsletter-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.newsletter-container textarea {
    height: 120px;
}

.single-class {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.single-class:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.single-class-image {
    height: 150px;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 15px;
}

.single-class-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.single-class-text {
    text-align: center;
    padding: 0 10px;
}

.single-class-text h4 {
    margin-bottom: 10px;
    font-size: 18px;
}

.single-class-text h4 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.single-class-text h4 a:hover {
    color: #007bff;
}

.single-class-text p {
    color: #666;
    margin-bottom: 0;
    font-size: 14px;
}

.single-class-text i {
    color: #007bff;
    margin-right: 5px;
}

.class-area {
    padding: 80px 0;
    background: #f8f9fa;
}

.section-title-wrapper {
    margin-bottom: 40px;
}

.section-title {
    text-align: center;
}

.section-title h3 {
    font-size: 32px;
    margin-bottom: 15px;
    color: #333;
}

.section-title p {
    color: #666;
    font-size: 16px;
}
</style>
@endpush 