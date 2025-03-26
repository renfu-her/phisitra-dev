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
                    <div class="school-image">
                        <img src="{{ asset('storage/' . $school['logo']) }}" alt="{{ $school['name'] }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $school['name'] }}</h5>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>{{ $school['location'] }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('schools.show', $school['id']) }}" class="btn btn-primary">
                                <i class="fas fa-info-circle me-2"></i>瀏覽學校
                            </a>
                            @if($school['website_url'])
                            <a href="{{ $school['website_url'] }}" class="btn btn-outline-primary" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>訪問網站
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- 合作花絮輪播 -->
        <div class="mt-5 mb-5">
            <h2 class="text-center mb-4">合作花絮</h2>
            @if($highlights['status'] ?? false)
                <div id="schoolGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach(collect($highlights['data'])->chunk(4) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach($chunk as $highlight)
                                        <div class="col-md-3">
                                            @if($highlight['media_type'] === 'video')
                                                <div class="gallery-video">
                                                    <div class="video-wrapper">
                                                        <iframe 
                                                            src="{{ asset('storage/' . $highlight['image']) }}" 
                                                            frameborder="0" 
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                            allowfullscreen>
                                                        </iframe>
                                                    </div>
                                                    <div class="gallery-caption">
                                                        <h6 class="mb-0">{{ $highlight['title'] }}</h6>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="gallery-image">
                                                    <img src="{{ asset('storage/' . $highlight['image']) }}" alt="{{ $highlight['title'] }}">
                                                    <div class="gallery-caption">
                                                        <h6 class="mb-0">{{ $highlight['title'] }}</h6>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#schoolGalleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">上一頁</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#schoolGalleryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">下一頁</span>
                    </button>
                </div>
            @else
                <div class="text-center">
                    <p class="lead">目前沒有合作花絮</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-5">
            <h3>想要成為合作學校？</h3>
            <p class="lead">我們歡迎更多優秀的學校加入我們的合作夥伴行列</p>
            <a href="{{ route('contact.index') }}" class="btn btn-primary">聯絡我們</a>
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-4">合作學校</h1>
            <p class="lead">資料不存在</p>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.school-image {
    height: 200px;
    overflow: hidden;
}

.school-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.gallery-image, .gallery-video {
    height: 200px;
    overflow: hidden;
    border-radius: 8px;
    margin: 0 5px;
    position: relative;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-image:hover img {
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

.gallery-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 8px;
    text-align: center;
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
    height: 40px;
    top: 50%;
    transform: translateY(-50%);
}

#schoolGalleryCarousel {
    padding: 0 30px;
}
</style>
@endpush 