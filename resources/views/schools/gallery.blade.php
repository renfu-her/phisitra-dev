@extends('layouts.app')

@section('title', '合作花絮 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>合作花絮</h1>
    </div>

    <!-- 影片區塊 -->
    <div class="mb-5">
        <h2 class="text-center mb-4">活動影片</h2>
        <div class="row g-4">
            @foreach($highlights['data'] as $highlight)
                @if($highlight['type'] === 'video')
                <div class="col-lg-6">
                    <div class="video-card">
                        <div class="video-wrapper">
                            <iframe 
                                src="{{ $highlight['url'] }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="video-content">
                            <h4>{{ $highlight['title'] }}</h4>
                            <p>{{ $highlight['description'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- 圖片區塊 -->
    <div>
        <h2 class="text-center mb-4">活動照片</h2>
        <div class="row g-4">
            @foreach($highlights['data'] as $highlight)
                @if($highlight['type'] === 'image')
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card">
                        <div class="gallery-image">
                            <img src="{{ Storage::url($highlight['image']) }}" 
                                 alt="{{ $highlight['title'] }}"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#galleryModal{{ $highlight['id'] }}">
                        </div>
                        <div class="gallery-content">
                            <h4>{{ $highlight['title'] }}</h4>
                            <p>{{ $highlight['description'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!-- 圖片放大 Modal -->
@foreach($highlights['data'] as $highlight)
    @if($highlight['type'] === 'image')
    <div class="modal fade" id="galleryModal{{ $highlight['id'] }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $highlight['title'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ Storage::url($highlight['image']) }}" 
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
.video-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 100%;
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

.video-content {
    padding: 1.5rem;
}

.video-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
}

.video-content p {
    margin: 0;
    color: #666;
}

.gallery-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 100%;
    cursor: pointer;
    transition: transform 0.2s;
}

.gallery-card:hover {
    transform: translateY(-5px);
}

.gallery-image {
    height: 250px;
    overflow: hidden;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.gallery-card:hover .gallery-image img {
    transform: scale(1.05);
}

.gallery-content {
    padding: 1.5rem;
}

.gallery-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
}

.gallery-content p {
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