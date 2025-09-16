@extends('layouts.home')

@section('desc')
    @include('frontend.HomeSection.desc')
@endsection

@section('content')
    @include('frontend.HomeSection.content', ['files' => $files, 'packages' => $packages, 'category' => $category])
@endsection

@section('footer')
    @include('frontend.HomeSection.footer')
@endsection

@section('scripts')
    @if (session('swal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "هشدار!",
                    text: 'کاربر گرامی برای استفاده از خدمات وبسایت شما باید ابتدا در وبسایت لاگین کنید',
                    icon: 'warning',
                    confirmButtonText: 'باشه'
                });
            });
        </script>
    @endif
@endsection