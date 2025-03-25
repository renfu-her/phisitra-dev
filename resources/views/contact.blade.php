@extends('layouts.app')

@section('title', '聯絡我們 - ' . config('app.name'))

@section('content')
@if($contact['status'] ?? false)
<!--Page Title Area Start-->
<div class="page-title-area section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>聯絡我們</h3>
                        <p>我們期待聽到您的聲音</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Page Title Area-->

<!--Contact Info Area Start-->
<div class="contact-info-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-contact-info">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <h4>地址</h4>
                        <p>{{ $contact['data']['address'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-contact-info">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-text">
                        <h4>電話</h4>
                        <p>{{ $contact['data']['phone'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-contact-info">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <h4>電子郵件</h4>
                        <p>{{ $contact['data']['email'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Contact Info Area-->

<!--Contact Form Area Start-->
<div class="contact-form-area section-padding section-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form">
                    <h3>發送訊息</h3>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.send') }}" method="POST">
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
                            <div class="col-md-12">
                                <button type="submit" class="button-default">送出訊息</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-sidebar">
                    <h3>營業時間</h3>
                    <ul>
                        @foreach($contact['data']['business_hours'] as $hours)
                            <li>
                                <span>{{ $hours['day'] }}：</span>
                                <span>{{ $hours['hours'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="social-links mt-4">
                        <h3>社群媒體</h3>
                        @if($contact['data']['facebook'])
                            <a href="{{ $contact['data']['facebook'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if($contact['data']['instagram'])
                            <a href="{{ $contact['data']['instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($contact['data']['line'])
                            <a href="{{ $contact['data']['line'] }}" target="_blank"><i class="fab fa-line"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Contact Form Area-->

<!--Map Area Start-->
@if($contact['data']['google_map'])
<div class="map-area">
    <iframe
        src="https://www.google.com/maps/embed?pb={{ $contact['data']['google_map'] }}"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
@endif
<!--End of Map Area-->
@else
<div class="container py-5">
    <div class="text-center">
        <h1 class="mb-4">聯絡我們</h1>
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

.contact-info-area {
    padding: 80px 0;
}

.single-contact-info {
    text-align: center;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.single-contact-info:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.contact-icon {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 20px;
}

.contact-text h4 {
    margin-bottom: 15px;
    color: #333;
}

.contact-text p {
    color: #666;
    margin-bottom: 0;
}

.contact-form-area {
    background: #f8f9fa;
    padding: 80px 0;
}

.contact-form {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.contact-form h3 {
    margin-bottom: 30px;
    color: #333;
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

.contact-info-sidebar {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.contact-info-sidebar h3 {
    margin-bottom: 20px;
    color: #333;
}

.contact-info-sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.contact-info-sidebar ul li {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    color: #666;
}

.social-links a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: #f8f9fa;
    color: #007bff;
    border-radius: 50%;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: #007bff;
    color: #fff;
}

.map-area {
    height: 450px;
}

.map-area iframe {
    width: 100%;
    height: 100%;
}
</style>
@endpush 