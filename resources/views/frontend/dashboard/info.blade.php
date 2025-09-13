@extends('layouts.user_dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


<div class="d-flex justify-content-center align-items-center mb-5 mt-5" style="min-height: 60vh;">
    <div class="card shadow-lg" style="width: 22rem;">
        <!-- عکس پروفایل -->
        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="card-img-top" alt="Profile Picture">

        <div class="card-body text-center">
            <!-- نام کاربر -->
            <h5 class="card-title">{{ $user->fullname }}</h5>
            <!-- ایمیل -->
            <p class="card-text text-muted">{{ $user->email }}</p>
        </div>

        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item">تاریخ عضویت: {{ $user->created_at->format('Y-m-d') }}</li>
            <li class="list-group-item">تعداد خریدها: {{ $user->purchases_count ?? 0 }}</li>
            <li class="list-group-item">پلن فعال: {{ $user->plan_name ?? 'ندارد' }}</li>
            <li class="list-group-item">موجودی کیف پول: {{ $user->wallet ?? 0 }}</li>
        </ul>

        <div class="card-body text-center">
            <a href="{{ route('frontend.user.dashboard.show') }}" class="btn btn-outline-primary mb-2">بازگشت به داشبورد</a>
            <a href="{{ route('frontend.user.dashboard.edit') }}" class="btn btn-outline-success">ویرایش اطلاعات کاربری</a>
        </div>
    </div>
</div>
@endsection
