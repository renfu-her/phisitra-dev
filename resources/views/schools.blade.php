@extends('layouts.app')

@section('title', '合作學校 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>合作學校</h1>
    </div>

    <div class="row g-4">
        @foreach($schools['data'] as $school)
        <div class="col-lg-4 col-md-6">
            <div class="school-card">
                <div class="school-image">
                    <img src="{{ Storage::url($school['logo']) }}" alt="{{ $school['name'] }}">
                </div>
                <div class="school-content">
                    <h4>{{ $school['name'] }}</h4>
                    <p><i class="fas fa-location-dot"></i> {{ $school['location'] }}</p>
                    @if($school['website_url'])
                    <a href="{{ $school['website_url'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-globe"></i> 訪問網站
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <h2>想要成為合作學校？</h2>
        <p class="mb-4">我們歡迎更多優秀的學校加入我們的合作夥伴行列</p>
        <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
    </div>
</div>
@endsection

@push('styles')
<style>
.school-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 100%;
}

.school-image {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.school-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.school-content {
    padding: 1.5rem;
}

.school-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
}

.school-content p {
    margin: 0;
    color: #666;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.school-content i {
    color: #007bff;
}

.school-content .btn {
    margin-top: 1rem;
}
</style>
@endpush 