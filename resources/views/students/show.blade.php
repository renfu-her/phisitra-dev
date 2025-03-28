@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card student-profile-card">
                    <div class="student-photo-wrapper">
                        <img src="{{ Storage::url($student['photo']) }}" class="card-img-top student-photo"
                            alt="{{ $student['name_zh'] }}" onerror="this.src='/images/default-student.jpg'">
                    </div>
                    <div class="card-body text-center">
                        <p class="student-en-name">{{ $student['name_en'] }}</p>
                        @if(Auth::guard('member')->check())
                            @if(isset($student['is_selected']) && $student['is_selected'])
                                <div class="student-tags">
                                    <span class="badge bg-primary">{{ $student['nationality'] }}</span>
                                    <span class="badge bg-info">{{ $student['department'] }}</span>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            @if(Auth::guard('member')->check())
                @if(isset($student['is_selected']) && $student['is_selected'])
                    <div class="col-md-8">
                        <div class="info-section">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <i class="fas fa-user-circle"></i>
                                            <h5>基本資料</h5>
                                        </div>
                                        <div class="info-card-body">
                                            <div class="info-item">
                                                <span class="info-label">性別</span>
                                                <span class="info-value">{{ $student['gender'] === 'male' ? '男' : '女' }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">生日</span>
                                                <span class="info-value">{{ $student['birth_date'] ?? '未提供' }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">國籍</span>
                                                <span class="info-value">{{ $student['nationality'] ?? '未提供' }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">護照號碼</span>
                                                <span class="info-value">{{ $student['passport_no'] ?? '未提供' }}</span>
                                            </div>
                                            @if ($student['overseas_address'])
                                                <div class="info-item">
                                                    <span class="info-label">海外地址</span>
                                                    <span class="info-value">{{ $student['overseas_address'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <i class="fas fa-graduation-cap"></i>
                                            <h5>學籍資料</h5>
                                        </div>
                                        <div class="info-card-body">
                                            <div class="info-item">
                                                <span class="info-label">學校</span>
                                                <span class="info-value">{{ $student['school_name'] ?? '未提供' }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">科系</span>
                                                <span class="info-value">{{ $student['department'] ?? '未提供' }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">入學日期</span>
                                                <span class="info-value">{{ $student['enrollment_date'] ?? '未提供' }}</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">修業年限</span>
                                                <span class="info-value">{{ $student['study_duration'] ?? '未提供' }} 年</span>
                                            </div>
                                            <div class="info-item">
                                                <span class="info-label">預計畢業</span>
                                                <span class="info-value">{{ $student['expected_graduation_date'] ?? '未提供' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($student['specialties'])
                                <div class="info-card mt-4">
                                    <div class="info-card-header">
                                        <i class="fas fa-star"></i>
                                        <h5>專長</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <p class="mb-0">{{ $student['specialties'] }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($student['remarks'])
                                <div class="info-card mt-4">
                                    <div class="info-card-header">
                                        <i class="fas fa-comment-alt"></i>
                                        <h5>備註</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <p class="mb-0">{{ $student['remarks'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            請先選擇此學生以查看詳細資料
                            <button onclick="toggleStudent({{ $student['id'] }})" class="btn btn-primary btn-sm ms-3">
                                <i class="fas fa-plus-circle me-1"></i>選擇學生
                            </button>
                        </div>
                    </div>
                @endif
            @else
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        請先登入以查看更多資訊
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm ms-3">
                            <i class="fas fa-sign-in-alt me-1"></i>登入
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
    function toggleStudent(studentId) {
        fetch(`/students/toggle/${studentId}/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            // if (data.status) {
            //     window.location.reload();
            // } else {
                alert(data.message || '操作失敗');
            // }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('操作失敗');
        });
    }
    </script>
    @endpush

    @push('styles')
        <style>
            .student-profile-card {
                border: none;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease;
            }

            .student-profile-card:hover {
                transform: translateY(-5px);
            }

            .student-photo-wrapper {
                position: relative;
                padding-top: 100%;
                overflow: hidden;
            }

            .student-photo {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .student-photo:hover {
                transform: scale(1.05);
            }

            .student-name {
                font-size: 1.8rem;
                font-weight: 600;
                margin: 1rem 0 0.5rem;
                color: #2d3748;
            }

            .student-en-name {
                font-size: 1.2rem;
                color: #718096;
                margin-bottom: 1rem;
            }

            .student-tags {
                display: flex;
                gap: 0.5rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .student-tags .badge {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .info-card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
                overflow: hidden;
            }

            .info-card-header {
                background: #f8fafc;
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #e2e8f0;
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .info-card-header i {
                font-size: 1.2rem;
                color: #4299e1;
            }

            .info-card-header h5 {
                margin: 0;
                color: #2d3748;
                font-weight: 600;
            }

            .info-card-body {
                padding: 1.5rem;
            }

            .info-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 0;
                border-bottom: 1px solid #edf2f7;
            }

            .info-item:last-child {
                border-bottom: none;
            }

            .info-label {
                color: #718096;
                font-weight: 500;
            }

            .info-value {
                color: #2d3748;
                font-weight: 500;
            }

            @media (max-width: 768px) {
                .student-profile-card {
                    margin-bottom: 2rem;
                }

                .info-item {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.5rem;
                }
            }
        </style>
    @endpush
@endsection
