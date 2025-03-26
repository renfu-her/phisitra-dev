@extends('layouts.app')

@section('title', $data['name'] . ' - ' . config('app.name'))

@section('content')
<div class="school-detail-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="school-detail-content">
                    <div class="school-header mb-4">
                        <h1>{{ $data['name'] }}</h1>
                        @if(!empty($data['location']))
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i> {{ $data['location'] }}
                            </p>
                        @endif
                        @if(!empty($data['country']))
                            <p class="country">
                                <i class="fas fa-globe"></i> {{ $data['country'] }}
                            </p>
                        @endif
                    </div>

                    @if(!empty($data['description']))
                        <div class="school-description mb-4">
                            <h3>學校簡介</h3>
                            <div class="content">
                                {!! $data['description'] !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="school-sidebar">
                    <div class="school-logo mb-4">
                        <img src="{{ !empty($data['logo']) ? Storage::url($data['logo']) : asset('images/no-image.png') }}" 
                             alt="{{ $data['name'] }}" 
                             class="img-fluid">
                    </div>
                    
                    <div class="school-info">
                        @if(!empty($data['website_url']))
                            <div class="info-item">
                                <h4>官方網站</h4>
                                <p><a href="{{ $data['website_url'] }}" target="_blank" rel="noopener noreferrer">訪問網站 <i class="fas fa-external-link-alt"></i></a></p>
                            </div>
                        @endif

                        @if(!empty($data['seo_keywords']))
                            <div class="info-item">
                                <h4>關鍵字</h4>
                                <p>{{ $data['seo_keywords'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.school-detail-area {
    padding: 80px 0;
    background: #f8f9fa;
}

.school-header h1 {
    margin-bottom: 15px;
    color: #333;
}

.location, .country {
    color: #666;
    margin-bottom: 10px;
}

.location i, .country i {
    color: #007bff;
    margin-right: 5px;
    width: 20px;
}

.school-description {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.school-description h3 {
    margin-bottom: 15px;
    color: #333;
}

.school-sidebar {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 20px;
}

.school-logo img {
    width: 100%;
    border-radius: 10px;
    aspect-ratio: 16/9;
    object-fit: cover;
}

.info-item {
    margin-bottom: 20px;
}

.info-item h4 {
    color: #333;
    margin-bottom: 10px;
}

.info-item a {
    color: #007bff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.info-item a:hover {
    text-decoration: underline;
}
</style>
@endpush 