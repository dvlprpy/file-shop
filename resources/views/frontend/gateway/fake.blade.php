@extends('layouts.gateway')

@section('content')

    <div class="container my-5">
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px; border-radius: 1rem;">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-primary">درگاه پرداخت آزمایشی</h4>
                <p class="text-muted">پرداخت برای پلن: <strong>{{ $plan->plan_title }}</strong></p>
            </div>

            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item d-flex justify-content-between">
                    <span>💰 مبلغ:</span>
                    <span>{{ number_format($plan->plan_price) }} تومان</span>
                </li>
            </ul>

            <form action="{{ route('frontend.fake.gateway.pay') }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->plan_id }}">

                <div class="col-12">
                    <label class="form-label">شماره کارت</label>
                    <input type="text" name="card_number" 
                        class="form-control @error('card_number') is-invalid @enderror" 
                        value="{{ old('card_number') }}" 
                        placeholder="---- ---- ---- ----" 
                        required>
                    @error('card_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">رمز دوم (پویا)</label>
                    <input type="password" name="second_password" 
                        class="form-control @error('second_password') is-invalid @enderror" 
                        value="{{ old('second_password') }}" 
                        placeholder="******" 
                        required>
                    @error('second_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">CVV2</label>
                    <input type="text" name="cvv2" 
                        class="form-control @error('cvv2') is-invalid @enderror" 
                        value="{{ old('cvv2') }}" 
                        placeholder="***" 
                        required>
                    @error('cvv2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">تاریخ انقضا</label>
                    <input type="text" name="expire_date" 
                        class="form-control @error('expire_date') is-invalid @enderror" 
                        value="{{ old('expire_date') }}" 
                        placeholder="MM/YY" 
                        required>
                    @error('expire_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-success w-100 py-2 fs-5">
                        ✅ پرداخت
                    </button>
                </div>

                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-danger w-100 py-2 fs-5"
                            onclick="window.location='{{ route('frontend.plan.buy') }}'">
                        ❌ انصراف
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
