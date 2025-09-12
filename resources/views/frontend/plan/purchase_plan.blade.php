@extends('layouts.home')

@section('content')
    <style>
        .plan-details-card-1 {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .plan-details-card-1:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }

        .plan-header-1 {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            text-align: center;
            padding: 1.5rem;
        }

        .plan-header-1 h4 {
            margin: 0;
            font-weight: bold;
        }

        .plan-info-1 {
            padding: 1rem 2rem;
        }

        .plan-info-1 li {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .plan-info-1 li:last-child {
            border-bottom: none;
        }

        .plan-buy-btn-style {
            border-radius: 30px;
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .plan-buy-btn-style:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="container">
        <div class="plan-details-card-1">
            {{-- بازگشت --}}
            <div class="p-3 text-start">
                <a href="{{ route('frontend.plan.buy') }}"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="bottom" 
                    data-bs-title="بازگشت به لیست پلن ها"
                    class="link-primary">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>

            {{-- هدر پلن --}}
            <div class="plan-header-1">
                <h4>{{ $plan_purch->plan_title }}</h4>
                <p class="mb-0">جزئیات پلن انتخابی شما</p>
            </div>

            {{-- جزئیات پلن --}}
            <ul class="plan-info-1 list-unstyled">
                <li><span>📥 تعداد دانلود مجاز</span> <span>{{ $plan_purch->plan_download_limit }}</span></li>
                <li><span>💰 قیمت پلن</span> <span>{{ number_format($plan_purch->plan_price) }} تومان</span></li>
                <li><span>📅 مدت اعتبار</span> <span>{{ $plan_purch->plan_day }} روز</span></li>
                <li><span>🗓 تاریخ خرید</span> <span>{{ $jalali_date_now }}</span></li>
                <li><span>⏳ تاریخ پایان</span> <span>{{ $jalali_date_next }}</span></li>
            </ul>

            {{-- دکمه خرید --}}
            <div class="text-center p-4">
                <form action="{{ route('frontend.fake.gateway.show', $plan_purch->plan_id ) }}" method="get">
                    <button class="btn btn-success plan-buy-btn-style">✅ تایید و انتقال به درگاه پرداخت</button>
                </form>
            </div>
        </div>
    </div>
@endsection