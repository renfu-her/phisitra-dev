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
        <div class="mt-5 mb-5" id="highlights-carousel">
            <h2 class="text-center mb-4">合作花絮</h2>
            <div v-if="loading" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">載入中...</span>
                </div>
            </div>
            <div v-else-if="highlights.length" class="carousel slide" id="schoolGalleryCarousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div v-for="(group, index) in highlightGroups" :key="index" :class="['carousel-item', index === 0 ? 'active' : '']">
                        <div class="row">
                            <div v-for="highlight in group" :key="highlight.id" class="col-md-3">
                                <div class="gallery-image">
                                    <img :src="highlight.image_url" :alt="highlight.title">
                                    <div class="gallery-caption">
                                        <h6 class="mb-0">@{{ highlight.title }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div v-else class="text-center">
                <p class="lead">目前沒有合作花絮</p>
            </div>
        </div>

        <div class="text-center mt-5">
            <h3>想要成為合作學校？</h3>
            <p class="lead">我們歡迎更多優秀的學校加入我們的合作夥伴行列</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
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

.gallery-image {
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

@push('scripts')
<script>
new Vue({
    el: '#highlights-carousel',
    data: {
        highlights: [],
        loading: true
    },
    computed: {
        highlightGroups() {
            const groups = [];
            for (let i = 0; i < this.highlights.length; i += 4) {
                groups.push(this.highlights.slice(i, i + 4));
            }
            return groups;
        }
    },
    mounted() {
        this.fetchHighlights();
    },
    methods: {
        async fetchHighlights() {
            try {
                const response = await fetch('/api/highlights');
                const result = await response.json();
                if (result.status) {
                    this.highlights = result.data;
                }
            } catch (error) {
                console.error('無法載入合作花絮:', error);
            } finally {
                this.loading = false;
            }
        }
    }
});
</script>
@endpush 