@extends('layouts.app')

@section('title', $school['name'] ?? '學校詳細資訊')

@section('content')
<div class="school-detail-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="school-detail-content">
                    <div class="school-header mb-4">
                        <h1>{{ $school['name'] ?? '未命名學校' }}</h1>
                        @if(!empty($school['location']))
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i> {{ $school['location'] }}
                            </p>
                        @endif
                    </div>

                    @if(!empty($school['description']))
                        <div class="school-description mb-4">
                            <h3>學校簡介</h3>
                            <div class="content">
                                {!! nl2br(e($school['description'])) !!}
                            </div>
                        </div>
                    @endif

                    @if(!empty($school['features']))
                        <div class="school-features mb-4">
                            <h3>特色優勢</h3>
                            <div class="features-list">
                                {!! nl2br(e($school['features'])) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="school-sidebar">
                    <div class="school-logo mb-4">
                        <img src="{{ $school['logo'] ? Storage::url($school['logo']) : asset('images/no-image.png') }}" 
                             alt="{{ $school['name'] ?? '未命名學校' }}" 
                             class="img-fluid">
                    </div>
                    
                    <div class="school-info">
                        @if(!empty($school['website']))
                            <div class="info-item">
                                <h4>官方網站</h4>
                                <p><a href="{{ $school['website'] }}" target="_blank">訪問網站 <i class="fas fa-external-link-alt"></i></a></p>
                            </div>
                        @endif
                        
                        @if(!empty($school['contact.index']))
                            <div class="info-item">
                                <h4>聯絡方式</h4>
                                <p>{!! nl2br(e($school['contact.index'])) !!}</p>
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

.location {
    color: #666;
}

.location i {
    color: #007bff;
    margin-right: 5px;
}

.school-description,
.school-features {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.school-description h3,
.school-features h3 {
    margin-bottom: 15px;
    color: #333;
}

.school-sidebar {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.school-logo img {
    width: 100%;
    border-radius: 10px;
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
}

.info-item a:hover {
    text-decoration: underline;
}
</style>
@endpush 