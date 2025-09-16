@extends('layouts.auth')

@section('content')
    
{{-- <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}



  <div class="d-flex justify-content-center align-items-center min-vh-100">
      <div class="card shadow-lg border-0 rounded-4 p-4 w-75" {{-- style="max-width: 420px; width: 100%;" --}}>
          <div class="text-center mb-2">
              <h3 class="fw-bold mb-4">👋 کد تایید</h3>
              <p class="text-muted small">
                کاربر گرامی یک توکن امنیتی برای ایمیل: <strong>{{ $userMail }}</strong> ارسال شد. لطفا ایمیل خود را بررسی نمائید و توکن را وارد نمائید.
              </p>
          </div>

          <form action="{{ route('password.forgot.verify.update') }}" method="post">
              @csrf

              {{-- Token --}}
              <div class="mb-3">
                  <label for='token-label' class="form-label">توکن امنیتی</label>
                  <input type="text" 
                      name="token" 
                      value="{{ old('token') }}" 
                      class="form-control form-control-lg @error('email') is-invalid @enderror" 
                      placeholder="لطفا توکن امنیتی را وارد کنید." id='token-label' autofocus>
                  @error('token') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
              </div>

              {{-- Submit button --}}
              <button class="btn btn-primary w-100 btn-lg">تایید و ادامه فرایند</button>
          </form>
      </div>
  </div>
@endsection

@section('scripts')
    @if(session('sweetalert'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire(@json(session('sweetalert')));
            });
        </script>
    @endif
@endsection