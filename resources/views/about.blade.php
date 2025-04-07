@extends('layouts.app')

@section('title', '關於我們 - ' . config('app.name'))

@section('content')
@if($about['status'] ?? false)
<!--Page Title Area Start-->
<div class="page-title-area section-padding" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>關於我們</h3>
                        <p>了解我們的故事和使命</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Page Title Area-->

<!--About Area Start-->
<div class="about-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion" id="aboutAccordion">
                    @foreach($about['data'] as $index => $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                {{ $item['title'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#aboutAccordion">
                            <div class="accordion-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="about-content">
                                            <div class="about-text">
                                                {!! $item['content'] !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
<!--End of About Area-->
@else
<div class="container py-5">
    <div class="text-center">
        <h1 class="mb-4">關於我們</h1>
        <p class="lead">資料不存在</p>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
.page-title-area {
    padding: 60px 0;
    text-align: center;
}

.about-area {
    padding: 80px 0;
}

.about-content {
    margin-bottom: 30px;
}

.about-text {
    color: #666;
    line-height: 1.8;
}

.about-text img {
    width: 100%;
    height: auto;
}

.about-image img {
    width: 100%;
}

.single-feature {
    text-align: center;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.single-feature:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.feature-icon {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 20px;
}

.single-feature h4 {
    margin-bottom: 15px;
    color: #333;
}

.single-feature p {
    color: #666;
    margin-bottom: 0;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #333;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,.125);
}
</style>
@endpush 