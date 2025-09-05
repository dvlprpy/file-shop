@extends('layouts.home')

@section('content')

    @php
        $size = (int) $file->file_size; // بایت
        if ($size >= 1073741824) {
            $readable = number_format($size / 1073741824, 2) . ' GB';
        } elseif ($size >= 1048576) {
            $readable = number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            $readable = number_format($size / 1024, 2) . ' KB';
        } else {
            $readable = $size . ' B';
        }
    @endphp

<div class="container py-5">

    <!-- اگر فایل پاس داده شده بود -->
    @isset($file)
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 hover-shadow">
                    <img src="{{ $file->thumbnail_url  ?? 'https://via.placeholder.com/300x200' }}" 
                         class="card-img-top" 
                         alt="{{ $file->file_title }}">
                </div>
            </div>
            <div class="col-md-8">
                <h1 class="mb-3">{{ $file->file_title }}</h1>
                <p class="text-muted">{{ $file->file_description }}</p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>فرمت:</strong>
                        @switch($file->file_type)
                            @case('pdf')
                                <i class="bi bi-filetype-pdf fs-3 text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="PDF"></i>
                                @break

                            @case('doc')
                                <i class="bi bi-filetype-doc fs-3 text-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Word Document"></i>
                                @break

                            @case('image/jpg')
                            @case('image/png')
                            @case('image/jpeg')
                                <i class="bi bi-image fs-3 text-success"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Image"></i>
                                @break

                            @default
                                <i class="bi bi-file-earmark fs-3 text-secondary"></i>
                        @endswitch
                    </li>
                    <li class="list-group-item"><strong>حجم:</strong> {{ $readable }}</li>
                    <li class="list-group-item"><strong>تاریخ انتشار:</strong> {{ $file->created_at->format('Y-m-d') }}</li>
                </ul>

                <div>
                    <a href="#" class="btn btn-success btn-lg shadow-sm hover-scale">خرید و دانلود فایل</a>
                </div>
            </div>
        </div>
    @endisset


    <!-- اگر پکیج پاس داده شده بود -->
    @isset($package)
        <div class="row g-4">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-8">
                <h1 class="mb-3">{{ $package->package_title }}</h1>
                <p class="text-muted">{{ $package->package_description }}</p>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>قیمت:</strong> {{ number_format($package->package_price) }} تومان</li>
                </ul>

                <div>
                    <a href="#" class="btn btn-primary btn-lg shadow-sm hover-scale">خرید این پکیج</a>
                </div>
            </div>
        </div>
    @endisset

</div>

<!-- Custom CSS -->
<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
    transition: all 0.3s ease;
}
.hover-scale:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease-in-out;
}
</style>
@endsection



@extends('layouts.home')

@section('content')
<div class="container py-5">
    @isset($file)
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 hover-shadow">
                <img src="{{ $file->thumbnail_url }}" class="card-img-top" alt="{{ $file->file_title }}">
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="mb-3">{{ $file->file_title }}</h1>
            <p class="text-muted">{{ $file->file_description }}</p>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>فرمت:</strong> {{ strtoupper($file->file_type) }}</li>
                <li class="list-group-item"><strong>حجم:</strong> {{ $file->readable_size }}</li>
                <li class="list-group-item"><strong>تاریخ انتشار:</strong> {{ $file->created_at->format('Y-m-d') }}</li>
            </ul>
            <a href="#" class="btn btn-success btn-lg shadow-sm hover-scale">خرید و دانلود فایل</a>
        </div>
    </div>
    @endisset

    @isset($package)
    <div class="row g-4">
        <div class="col-md-8 offset-md-2 text-center">
            <h1 class="mb-3">{{ $package->package_title }}</h1>
            <p class="text-muted">{{ $package->package_description }}</p>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>قیمت:</strong> {{ number_format($package->package_price) }} تومان</li>
            </ul>
            <a href="#" class="btn btn-primary btn-lg shadow-sm hover-scale">خرید این پکیج</a>
        </div>
    </div>
    @endisset
</div>
@endsection