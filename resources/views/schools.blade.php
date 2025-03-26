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

    <!-- 合作花絮 -->
    <div class="mt-5">
        <h2 class="text-center mb-4">合作花絮</h2>
        <div class="row g-4">
            @foreach($highlights['data'] as $highlight)
                <div class="col-lg-4 col-md-6">
                    @if($highlight['media_type'] === 'movie')
                        <div class="highlight-card">
                            <div class="video-wrapper">
                                <iframe 
                                    src="{{ $highlight['media_path'] }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <div class="highlight-content">
                                <h4>{{ $highlight['title'] }}</h4>
                                <p>{{ $highlight['description'] }}</p>
                            </div>
                        </div>
                    @else
                        <div class="highlight-card">
                            <div class="highlight-image">
                                <img src="{{ Storage::url($highlight['media_path']) }}" 
                                     alt="{{ $highlight['title'] }}"
                                     data-bs-toggle="modal" 
                                     data-bs-target="#highlightModal{{ $highlight['id'] }}">
                            </div>
                            <div class="highlight-content">
                                <h4>{{ $highlight['title'] }}</h4>
                                <p>{{ $highlight['description'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center mt-5">
        <h2>想要成為合作學校？</h2>
        <p class="mb-4">我們歡迎更多優秀的學校加入我們的合作夥伴行列</p>
        <a href="{{ route('contact.index') }}" class="btn btn-primary">聯絡我們</a>
    </div>
</div>

<!-- 圖片放大 Modal -->
@foreach($highlights['data'] as $highlight)
    @if($highlight['media_type'] === 'image')
    <div class="modal fade" id="highlightModal{{ $highlight['id'] }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $highlight['title'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ Storage::url($highlight['media_path']) }}" 
                         alt="{{ $highlight['title'] }}" 
                         class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
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

.highlight-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 100%;
    transition: transform 0.2s;
}

.highlight-card:hover {
    transform: translateY(-5px);
}

.highlight-image {
    height: 250px;
    overflow: hidden;
}

.highlight-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.highlight-card:hover .highlight-image img {
    transform: scale(1.05);
}

.video-wrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 比例 */
    height: 0;
    overflow: hidden;
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.highlight-content {
    padding: 1.5rem;
}

.highlight-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
}

.highlight-content p {
    margin: 0;
    color: #666;
}

.modal-body {
    padding: 0;
}

.modal-body img {
    width: 100%;
    height: auto;
}
</style>
@endpush 