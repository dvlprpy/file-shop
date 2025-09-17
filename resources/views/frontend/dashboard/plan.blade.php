@extends('layouts.user_dashboard')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold">لیست پلن‌های کاربر</h2>
    <div class="d-flex flex-row flex-wrap justify-content-center align-items-stretch gap-4">
        @if (count($subscribe) > 0)
            @foreach ($subscribe as $subscribeItem)
                <div class="card user-dashboard-plan-card p-3 shadow border-0 rounded-4" style="width: 22rem; transition: all .2s;">
                    <div class="card-body text-center bg-light rounded-top-4">
                        <h5 class="card-title mb-1">{{ $user->fullname }}</h5>
                        <p class="card-text text-muted small">{{ $user->email }}</p>
                    </div>
                    
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">
                            <i class="bi bi-box-seam me-1 text-primary"></i>
                            عنوان پلن: <span class="fw-bold">{{ $subscribeItem->plan->plan_title }}</span>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-cash-coin me-1 text-success"></i>
                            قیمت پلن: <span class="fw-bold">{{ number_format($subscribeItem->plan->plan_price) }} تومان</span>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-download me-1 text-info"></i>
                            سقف دانلود مجاز: {{ $subscribeItem->subscribe_download_limit }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-activity me-1 text-warning"></i>
                            تعداد دانلود فعلی: {{ $subscribeItem->subscribe_download_count }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar-check me-1 text-primary"></i>
                            تاریخ خرید: {{ \Morilog\Jalali\Jalalian::forge($subscribeItem->subscribe_created_at)->format('%A, %d %B %Y') }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar-x me-1 text-danger"></i>
                            تاریخ انقضا: {{ \Morilog\Jalali\Jalalian::forge($subscribeItem->subscribe_expired_at)->format('%A, %d %B %Y') }}
                        </li>
                    </ul>
                </div>
            @endforeach
        @else
            <p class='text-center text-muted'>هیچ اطلاعاتی درباره پلن های شما وجود ندارد</p>
        @endif
        
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('frontend.user.dashboard.show') }}" class="btn btn-primary px-4">
            بازگشت به داشبورد
        </a>
    </div>
</div>
@endsection