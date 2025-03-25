@extends('layouts.app')

@section('title', '服務項目 - ' . config('app.name'))

@section('content')
@if($services['status'] ?? false)
<!--Page Title Area Start-->
<div class="page-title-area section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>服務項目</h3>
                        <p>我們提供的專業服務</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Page Title Area-->

<!--Service Area Start-->
<div class="service-area section-padding">
    <div class="container">
        <div class="row">
            @foreach($services['data'] as $service)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="single-service">
                    @if($service['image'])
                    <div class="service-image mb-4">
                        <img src="{{ Storage::url($service['image']) }}" alt="{{ $service['title'] }}" class="img-fluid rounded">
                    </div>
                    @endif
                    <div class="service-content">
                        <h4>{{ $service['title'] }}</h4>
                        <div class="service-text">
                            {!! $service['description'] !!}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--End of Service Area-->

<!--Contact Area Start-->
<div class="contact-area section-padding section-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>需要協助？</h3>
                        <p>聯絡我們了解更多服務細節</p>
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
        <h1 class="mb-4">服務項目</h1>
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

.service-area {
    padding: 80px 0;
}

.single-service {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    transition: all 0.3s ease;
    height: 100%;
}

.single-service:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.service-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.service-content h4 {
    margin-bottom: 15px;
    color: #333;
}

.service-text {
    color: #666;
    line-height: 1.8;
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

.section-gray {
    background: #f8f9fa;
}
</style>
@endpush 