@extends('layouts.app')

@section('title', '合作學校 - ' . config('app.name'))

@section('content')
@if($schools['status'] ?? false)
<!--Page Title Area Start-->
<div class="page-title-area section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper text-center">
                    <div class="section-title">
                        <h3>合作學校</h3>
                        <p>我們的優質合作夥伴</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Page Title Area-->

<!--Schools Area Start-->
<div class="schools-area section-padding">
    <div class="container">
        <div class="row g-4">
            @foreach($schools['data'] as $school)
            <div class="col-lg-4 col-md-6">
                <div class="single-school">
                    <div class="school-image">
                        <img src="{{ Storage::url($school['logo']) }}" alt="{{ $school['name'] }}">
                    </div>
                    <div class="school-content">
                        <h4>{{ $school['name'] }}</h4>
                        <div class="school-info">
                            <p><i class="fas fa-map-marker-alt"></i> {{ $school['location'] }}</p>
                            @if($school['website_url'])
                                <p><i class="fas fa-globe"></i> <a href="{{ $school['website_url'] }}" target="_blank">訪問網站</a></p>
                            @endif
                        </div>
                        <div class="school-meta">
                            <span><i class="fas fa-calendar"></i> 合作開始：{{ $school['cooperation_date'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--End of Schools Area-->

<!--Contact Area Start-->
<div class="contact-area section-padding section-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper text-center">
                    <div class="section-title">
                        <h3>想了解更多？</h3>
                        <p>歡迎與我們聯繫，了解更多合作學校資訊</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" placeholder="您的姓名" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" placeholder="電子郵件" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subject" placeholder="主旨" required>
                            </div>
                            <div class="col-md-12">
                                <textarea name="message" placeholder="您的訊息" required></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="button-default">送出訊息</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Contact Area-->
@else
<div class="container py-5">
    <div class="text-center">
        <h1 class="mb-4">合作學校</h1>
        <p class="lead">資料不存在</p>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
.page-title-area {
    padding: 60px 0;
}

.schools-area {
    padding: 80px 0;
}

.single-school {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.single-school:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.school-image {
    height: 200px;
    overflow: hidden;
    background: #f8f9fa;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.school-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.school-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.school-content h4 {
    margin-bottom: 15px;
    color: #333;
    font-size: 1.2rem;
}

.school-info {
    margin-bottom: 15px;
}

.school-info p {
    color: #666;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.school-info i {
    color: #007bff;
    width: 20px;
    margin-right: 8px;
}

.school-info a {
    color: #007bff;
    text-decoration: none;
}

.school-info a:hover {
    text-decoration: underline;
}

.school-meta {
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #eee;
    color: #666;
    font-size: 0.9rem;
}

.school-meta i {
    color: #007bff;
    margin-right: 5px;
}

.contact-area {
    background: #f8f9fa;
}

.contact-form {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.contact-form textarea {
    height: 150px;
}

.button-default {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.button-default:hover {
    background: #0056b3;
}

.section-gray {
    background: #f8f9fa;
}
</style>
@endpush 