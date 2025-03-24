@extends('layouts.app')

@section('title', '聯絡我們 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    @if($contact['status'] ?? false)
        <h1 class="text-center mb-5">{{ $contact['data']['title'] }}</h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-4">聯絡資訊</h3>
                        <div class="mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>{{ $contact['data']['address'] }}</span>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <span>{{ $contact['data']['phone'] }}</span>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <span>{{ $contact['data']['email'] }}</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">營業時間</h3>
                        @foreach($contact['data']['business_hours'] as $hours)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $hours['day'] }}</span>
                                <span>{{ $hours['hours'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">聯絡表單</h3>
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
                    <div class="card-body p-0">
                        {!! $contact['data']['map_embed'] !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-4">聯絡我們</h1>
            <p class="lead">資料不存在</p>
        </div>
    @endif
</div>
@endsection 