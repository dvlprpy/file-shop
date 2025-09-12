@extends('layouts.home')

@section('content')
    {{-- پیام موفقیت یا خطا --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
    <div class="text-center mb-4 text-body-secondary">
        <h6 class=''>لیست پلن های سایت</h4>
        <div class=" mt-4 d-flex flex-row flex-wrap justify-content-evenly align-items-center">
            @foreach ($plans as $plan)
                <div class="card plan-card mb-4" style="width: 20rem;">
                    <img src="{{ asset('images/Plan.jpg') }}" class="card-img-top" alt="Plan Image">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $plan->plan_title }}</h5>
                        <p class="card-text text-muted">
                            با خرید هر پلن می‌توانید از خدمات وبسایت ما استفاده کنید. 
                            لطفاً هنگام انتخاب به تعداد دانلودها و مدت زمان اعتبار توجه کنید.
                        </p>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">
                            <strong>تعداد دانلود:</strong> {{ $plan->plan_download_limit }}
                        </li>
                        <li class="list-group-item">
                            <strong>قیمت:</strong> {{ number_format($plan->plan_price) }} تومان
                        </li>
                        <li class="list-group-item">
                            <strong>مدت زمان:</strong> {{ $plan->plan_day }} روز
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('frontend.plan.purchase', $plan->plan_id ) }}" 
                            class="btn btn-primary w-100">🚀 خرید پلن</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection