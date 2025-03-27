@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ Storage::url($student['photo']) }}" class="card-img-top student-photo"
                        alt="{{ $student['name_zh'] }}" onerror="this.src='/images/default-student.jpg'">
                </div>
            </div>
            <div class="col-md-8">
                <h1 class="mb-4">{{ $student['name_zh'] }}</h1>
                <h3 class="text-muted mb-4">{{ $student['name_en'] }}</h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3"></div>
                            <h5>基本資料</h5>
                            <p><strong>性別：</strong>{{ $student['gender'] === 'male' ? '男' : '女' }}</p>
                            <p><strong>生日：</strong>{{ $student['birth_date'] ?? '未提供' }}</p>
                            <p><strong>國籍：</strong>{{ $student['nationality'] ?? '未提供' }}</p>
                            <p><strong>護照號碼：</strong>{{ $student['passport_no'] ?? '未提供' }}</p>
                            @if ($student['overseas_address'])
                                <p><strong>海外地址：</strong>{{ $student['overseas_address'] }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5>學籍資料</h5>
                            <p><strong>學校：</strong>{{ $student['school_name'] ?? '未提供' }}</p>
                            <p><strong>科系：</strong>{{ $student['department'] ?? '未提供' }}</p>
                            <p><strong>入學日期：</strong>{{ $student['enrollment_date'] ?? '未提供' }}</p>
                            <p><strong>修業年限：</strong>{{ $student['study_duration'] ?? '未提供' }} 年</p>
                            <p><strong>預計畢業日期：</strong>{{ $student['expected_graduation_date'] ?? '未提供' }}</p>
                        </div>
                    </div>
                </div>

                @if ($student['specialties'])
                    <div class="mb-3">
                        <h5>專長</h5>
                        <p>{{ $student['specialties'] }}</p>
                    </div>
                @endif

                @if ($student['remarks'])
                    <div class="mb-3">
                        <h5>備註</h5>
                        <p>{{ $student['remarks'] }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .student-photo {
                height: 400px;
                object-fit: cover;
            }

            h5 {
                color: #333;
                margin-bottom: 1rem;
            }

            .card {
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush
@endsection
