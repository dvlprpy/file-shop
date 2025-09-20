@extends('layouts.auth')

@section('content')

  <div class="d-flex justify-content-center align-items-center min-vh-100">
      <div class="card shadow-lg border-0 rounded-4 p-4 w-75" >
          <div class="text-center mb-2">
              <h3 class="fw-bold mb-4">👋 تنظیم رمز عبور جدید</h3>
              <p class="text-muted small">
                کاربر گرامی لطفا اطلاعات خواسته شده را با دقت وارد کنید تا رمز عبور جدید شما با موفقیت اعمال گردد.
              </p>
          </div>

          <form action="{{ route('password.forgot.update') }}" method="post" id="resetForm">
              @csrf

              {{-- Email --}}
              <div class="mb-3">
                  <label for='email' class="form-label">ایمیل</label>
                  <input type="email" 
                      name="email" 
                      value="{{ $email ?? old('email') }}" 
                      class="form-control form-control-lg @error('email') is-invalid @enderror" 
                      placeholder="لطفا ایمیل خود را وارد کنید." autofocus
                      id='email'>
                  @error('email') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
              </div>

              {{-- Token --}}
              <div class="mb-3">
                  <label for='token' class="form-label">توکن</label>
                  <input type="text" 
                      name="token" 
                      value="{{ $token ?? '' }}" 
                      class="form-control form-control-lg @error('token') is-invalid @enderror" 
                      placeholder="لطفا توکن امنیتی خود را وارد کنید." autofocus
                      id='token'>
                  @error('token') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
              </div>

              {{-- Password --}}
              <div class="mb-3">
                  <label for='password' class="form-label">رمز عبور جدید</label>
                  <input type="password" 
                      name="password" 
                      class="form-control form-control-lg @error('password') is-invalid @enderror" 
                      placeholder="لطفا رمز عبور خود را وارد کنید." autofocus
                      id='password'>
                  @error('password') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
              </div>


              {{-- Confirmation Password --}}
              <div class="mb-3">
                  <label for='password_confirmation' class="form-label">تکرار رمز عبور جدید</label>
                  <input type="password" 
                      name="password_confirmation" 
                      class="form-control form-control-lg @error('password') is-invalid @enderror" 
                      placeholder="لطفا رمز عبور خود را وارد کنید." autofocus
                      id='password_confirmation'>
                  @error('password') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
              </div>

              {{-- Submit button --}}
              <button class="btn btn-success w-100 btn-lg">تایید و ثبت رمز عبور جدید</button>
          </form>
      </div>
  </div>

<script>
  

  // اگر QueryString حاوی token هست، در input قرار بده (برای اطمینان)
  (function(){
    const params = new URLSearchParams(window.location.search);
    if (params.has('token') && !document.getElementById('token').value) {
      document.getElementById('token').value = params.get('token');
    }
  })();
</script>
@endsection