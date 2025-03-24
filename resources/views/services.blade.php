@extends('layouts.app')

@section('title', '服務項目')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">服務項目</h1>

    <div class="row g-4">
        @foreach($services as $service)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="{{ $service['icon'] }} fa-3x text-primary mb-3"></i>
                    <h3 class="card-title">{{ $service['title'] }}</h3>
                    <p class="card-text">{{ $service['description'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">需要更多資訊？</h3>
                    <p class="card-text">歡迎聯絡我們，我們將為您提供詳細的服務說明。</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 