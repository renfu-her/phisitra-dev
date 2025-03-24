@extends('layouts.app')

@section('title', '合作花絮 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    @if($galleries['status'] ?? false)
        <h1 class="text-center mb-5">合作花絮</h1>

        <!-- 篩選按鈕 -->
        <div class="text-center mb-4">
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn active" data-category="all">全部</button>
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn" data-category="activity">活動照片</button>
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn" data-category="campus">校園風光</button>
            <button class="btn btn-outline-primary mb-2 filter-btn" data-category="student">學生生活</button>
        </div>

        <!-- 相簿網格 -->
        <div class="row g-4">
            @foreach($galleries['data'] as $gallery)
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
    @else
        <div class="text-center">
            <h1 class="mb-4">合作花絮</h1>
            <p class="lead">資料不存在</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // 移除所有按鈕的 active 類別
            filterBtns.forEach(b => b.classList.remove('active'));
            // 添加當前按鈕的 active 類別
            this.classList.add('active');

            const category = this.dataset.category;

            galleryItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
@endsection 