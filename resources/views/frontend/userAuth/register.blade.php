@extends('layouts.auth')

@section('content')

    @if (session('registerError'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="direction: ltr; text-align: center;">
            <div class="flex-grow-1">
                {{ session('registerError') }}
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 1rem;">
            <h3 class="text-center mb-4">ثبت‌نام</h3>

            <form action="{{ route('frontend.register') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- fullname --}}
                <div class="mb-3">
                    <label class="form-label">نام و نام خانوادگی</label>
                    <input type="text" name="fullname" value="{{ old('fullname') }}"
                        class="form-control @error('fullname') is-invalid @enderror"
                        placeholder="مثال: علی رضایی">
                    @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- username --}}
                <div class="mb-3">
                    <label class="form-label">نام کاربری</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="مثال: ali_reza">
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- email --}}
                <div class="mb-3">
                    <label class="form-label">ایمیل</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="example@email.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- phone --}}
                <div class="mb-3">
                    <label class="form-label">شماره موبایل</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror"
                        placeholder="0912xxxxxxx">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- password --}}
                <div class="mb-3">
                    <label class="form-label">کلمه عبور</label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="رمز عبور خود را وارد کنید">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- profile picture --}}
                <div class="mb-3">
                    <label class="form-label">عکس پروفایل</label>
                    <input type="file" name="profile_picture"
                        class="form-control @error('profile_picture') is-invalid @enderror">
                    @error('profile_picture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- submit button --}}
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success w-100">ثبت‌نام</button>
                </div>

                {{-- login redirect --}}
                <p class="text-center mt-3 mb-0">
                    قبلاً حساب کاربری ساخته‌اید؟ <a href="{{ route('frontend.login.form') }}">وارد شوید</a>
                </p>
            </form>
        </div>
    </div>
@endsection
