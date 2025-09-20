@extends('layouts.auth')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg border-0 rounded-4 p-4 w-75">
      <div class="text-center mb-4">
          <h3 class="fw-bold">👋 بازیابی رمز عبور</h3>
          <p class="text-muted small">
            کاربر گرامی، برای انجام فرایند فراموشی رمز عبور، لطفاً ایمیل خود را وارد کنید.
          </p>
      </div>

      <form action="{{ route('password.forgot.form.request') }}" method="post">
          @csrf

          {{-- Email --}}
          <div class="mb-3">
              <label class="form-label">نام کاربری (ایمیل)</label>
              <input type="email" 
                  name="email" 
                  value="{{ old('email') }}" 
                  class="form-control form-control-lg @error('email') is-invalid @enderror" 
                  placeholder="example@gmail.com" autofocus>
              @error('email') 
                  <div class="invalid-feedback">{{ $message }}</div> 
              @enderror
          </div>

          {{-- Submit button --}}
          <button class="btn btn-primary w-100 btn-lg">ارسال لینک بازیابی</button>
      </form>
  </div>
</div>
@endsection

@section('scripts')
    @if(session('token_time_expire'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire(@json(session('token_time_expire')));
            });
        </script>
    @endif
@endsection