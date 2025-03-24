@extends('layouts.app')

@section('title', '合作花絮')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">合作花絮</h1>

    <!-- 相簿分類 -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-outline-primary active" data-filter="all">全部</button>
                <button class="btn btn-outline-primary" data-filter="activity">活動照片</button>
                <button class="btn btn-outline-primary" data-filter="campus">校園風光</button>
                <button class="btn btn-outline-primary" data-filter="student">學生生活</button>
            </div>
        </div>
    </div>

    <!-- 相簿網格 -->
    <div class="row g-4">
        @foreach($galleries as $gallery)
        <div class="col-md-4 col-lg-3 gallery-item" data-category="{{ $gallery['category'] }}">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $gallery['image']) }}" class="card-img-top" alt="{{ $gallery['title'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $gallery['title'] }}</h5>
                    <p class="card-text">{{ $gallery['description'] }}</p>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($gallery['date'])->format('Y/m/d') }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // 相簿分類篩選
    $('.btn[data-filter]').click(function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
        
        var filter = $(this).data('filter');
        if (filter === 'all') {
            $('.gallery-item').show();
        } else {
            $('.gallery-item').hide();
            $('.gallery-item[data-category="' + filter + '"]').show();
        }
    });
});
</script>
@endpush
@endsection 