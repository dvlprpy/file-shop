@extends('layouts.auth')

@section('content')

    @if (session('loginError'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="direction: ltr; text-align: center;">
            <div class="flex-grow-1">
                {{ session('loginError') }}
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 420px; width: 100%;">
            <div class="text-center mb-4">
                <h3 class="fw-bold">👋 ورود به حساب کاربری</h3>
                <p class="text-muted small">خوش برگشتی! لطفا اطلاعات خود را وارد کنید.</p>
            </div>

            <form action="{{ route('frontend.login') }}" method="post">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">نام کاربری (ایمیل)</label>
                    <input type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="form-control form-control-lg @error('email') is-invalid @enderror" 
                        placeholder="ایمیل خود را وارد کنید" autofocus>
                    @error('email') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">کلمه عبور</label>
                    <input type="password" 
                        name="password" 
                        class="form-control form-control-lg @error('password') is-invalid @enderror" 
                        placeholder="رمز عبور خود را وارد کنید">
                    @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" 
                            name="remember" 
                            class="form-check-input" 
                            id="remember" 
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="remember">مرا به خاطر بسپار</label>
                    </div>
                    <a href="{{ route('password.forgot.form') }}" class="text-decoration-none small">رمز عبور را فراموش کرده‌اید؟</a>
                </div>

                {{-- Submit button --}}
                <button class="btn btn-primary w-100 btn-lg">ورود</button>
            </form>

            <div class="text-center mt-4">
                <p class="small mb-0">
                    حساب کاربری ندارید؟
                    <a href="{{ route('frontend.register.form') }}" class="fw-bold text-decoration-none">ثبت‌نام کنید</a>
                </p>
            </div>
        </div>
    </div>
@endsection
