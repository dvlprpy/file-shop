@extends('layouts.home')

@section('content')
    <!-- About Us Section -->
    <section class="py-5 bg-light">
    <div class="container">
        <!-- عنوان -->
        <div class="text-center mb-5">
        <h1 class="fw-bold mb-3">درباره ما</h1>
        <p class="text-muted fs-5">
            ما در <strong>فایل شاپ</strong> فایل‌ها و پکیج‌های باکیفیت ارائه می‌کنیم تا تجربه خریدی سریع، مطمئن و ساده برای شما فراهم شود.
        </p>
        </div>

        <!-- ویژگی‌ها -->
        <div class="row text-center mb-5">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="display-4 mb-3 text-primary">💎</div>
                <h5 class="card-title fw-bold">کیفیت بالا</h5>
                <p class="card-text text-muted">
                تمامی فایل‌ها و پکیج‌های ما از منابع معتبر تهیه و بررسی می‌شوند.
                </p>
            </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="display-4 mb-3 text-success">⚡️</div>
                <h5 class="card-title fw-bold">دانلود سریع</h5>
                <p class="card-text text-muted">
                با سرورهای قدرتمند، فایل‌ها را بدون وقفه دانلود کنید.
                </p>
            </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="display-4 mb-3 text-info">🔒</div>
                <h5 class="card-title fw-bold">امنیت پرداخت</h5>
                <p class="card-text text-muted">
                اطلاعات شما در بالاترین سطح امنیتی نگهداری می‌شود.
                </p>
            </div>
            </div>
        </div>
        </div>

        <!-- دعوت به اقدام -->
        <div class="text-center bg-primary text-white p-5 rounded-3">
        <h2 class="fw-bold mb-3">به ما بپیوندید</h2>
        <p class="mb-4 fs-5">
            همین حالا حساب کاربری خود را بسازید و از مزایای ویژه خرید فایل بهره‌مند شوید.
        </p>
        <a href="{{ route('frontend.register.form') }}" class="btn btn-light btn-lg fw-bold">
            ساخت حساب کاربری
        </a>
        </div>
    </div>
    </section>

@endsection