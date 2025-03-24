@extends('layouts.app')

@section('title', '個人資料 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">個人資料</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">電子郵件</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">電話</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">頭像</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            @if(isset($user->avatar))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="頭像" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">新密碼</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text">如果不需要更改密碼，請留空</div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">確認新密碼</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">更新資料</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 