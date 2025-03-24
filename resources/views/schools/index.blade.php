@extends('layouts.app')

@section('title', '合作學校 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    @if($schools['status'] ?? false)
        <h1 class="text-center mb-5">合作學校</h1>

        <div class="row g-4">
            @foreach($schools['data'] as $school)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $school['logo']) }}" class="card-img-top" alt="{{ $school['name'] }}" style="height: 200px; object-fit: contain;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $school['name'] }}</h5>
                        <p class="card-text">{{ $school['description'] }}</p>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>{{ $school['location'] }}</span>
                        </div>
                        <a href="{{ $school['website_url'] }}" class="btn btn-outline-primary" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>訪問網站
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <h3>想要成為合作學校？</h3>
            <p class="lead">我們歡迎更多優秀的學校加入我們的合作夥伴行列</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-4">合作學校</h1>
            <p class="lead">資料不存在</p>
        </div>
    @endif
</div>
@endsection 