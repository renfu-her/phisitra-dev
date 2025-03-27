@extends('layouts.app')

@section('content')
<div class="class-area section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>學生專區</h3>
                        <p>我們的優秀學生</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @forelse($students as $student)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-student">
                        <div class="student-image">
                            <img src="{{ $student['photo'] }}" 
                                 alt="{{ $student['name_zh'] }}" 
                                 class="img-fluid">
                        </div>
                        <div class="student-info">
                            <h4>{{ $student['name_zh'] }}</h4>
                            <p>{{ $student['name_en'] }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>目前沒有學生資料</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.single-student {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.single-student:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.student-image {
    position: relative;
    padding-top: 100%; /* 1:1 寬高比 */
    overflow: hidden;
}

.student-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.student-info {
    padding: 1.5rem;
    text-align: center;
}

.student-info h4 {
    margin: 0;
    font-size: 1.25rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.student-info p {
    margin: 0;
    color: #666;
    font-size: 1rem;
}

.section-padding {
    padding: 80px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 50px;
}

.section-title h3 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #333;
}

.section-title p {
    color: #666;
    font-size: 1.1rem;
}
</style>
@endpush 