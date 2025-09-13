@extends('layouts.user_dashboard')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>خطا!</strong> لطفاً موارد زیر را بررسی کنید:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center mb-5 mt-4" style="min-height: 80vh;">
        <div class="card shadow-lg border-0" style="width: 32rem; border-radius: 1rem;">
            <div class="card-body p-4">
                <h4 class="text-center mb-4">✏️ ویرایش اطلاعات کاربری</h4>

                <form action="{{ route('frontend.user.dashboard.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Fullname -->
                    <div class="mb-3">
                        <label for="fullname" class="form-label">نام و نام خانوادگی</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">نام کاربری</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">شماره تماس</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">رمز عبور جدید</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="در صورت نیاز به تغییر وارد کنید">
                    </div>

                    <!-- Profile Picture -->
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">تصویر پروفایل</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                        
                        @if($user->profile_picture)
                            <div class="text-center mt-3">
                                <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile" class="rounded-circle shadow" width="100" height="100">
                            </div>
                        @endif
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">💾 ذخیره تغییرات</button>
                        <a href="{{ route('frontend.user.dashboard.show') }}" class="btn btn-outline-secondary">↩️ بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


