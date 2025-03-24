@extends('layouts.app')

@section('title', $contact['seo_title'] ?? '聯絡我們')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="mb-4">{{ $contact['title'] }}</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">聯絡資訊</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {{ $contact['address'] }}
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            {{ $contact['phone'] }}
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            {{ $contact['email'] }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">營業時間</h5>
                    <ul class="list-unstyled">
                        @foreach($contact['business_hours'] as $day => $hours)
                        <li class="mb-2">{{ $day }}：{{ $hours }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">聯絡表單</h5>
                    <form action="{{ route('contact.send') }}" method="POST">
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

    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">地圖</h5>
                    <div class="ratio ratio-16x9">
                        {!! $contact['map_embed'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 