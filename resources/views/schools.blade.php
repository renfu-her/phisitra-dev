@extends('layouts.app')

@section('title', '合作學校')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">合作學校</h1>

    <div class="row g-4">
        @foreach($schools as $school)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $school['logo']) }}" class="card-img-top" alt="{{ $school['name'] }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $school['name'] }}</h3>
                    <p class="card-text">{{ $school['description'] }}</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $school['location'] }}</li>
                        <li><i class="fas fa-globe text-primary me-2"></i><a href="{{ $school['website_url'] }}" target="_blank">官方網站</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">成為合作學校</h3>
                    <p class="card-text">歡迎有興趣的學校與我們聯繫，一起為國際學生提供更好的教育環境。</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 