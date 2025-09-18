@extends('layouts.home')

@section('content')

    <div class="container py-5">

        <!-- اگر فایل پاس داده شده بود -->
        @isset($file)
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
                    @if ($subscription['status'])
                        <div>
                            <a href="{{ route('frontend.file.download', $file->file_id) }}" class="btn btn-primary btn-lg shadow-sm hover-scale">دانلود فایل</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('frontend.plan.buy') }}" class="btn btn-success btn-lg shadow-sm hover-scale">خرید پلن</a>
                        </div>
                    @endif
                    
                </div>
            </div>
        @endisset


        <!-- اگر پکیج پاس داده شده بود -->
        @isset($package)
            <div class="row mb-4">
                <div class="col-md-8 offset-md-2">
                    <div class="card border-0 shadow-lg rounded-4">
                        <div class="card-body text-center">
                            <h1 class="fw-bold mb-3">{{ $package->package_title }}</h1>
                            <p class="text-muted">{{ $package->package_description }}</p>
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                @if ($subscription['status'])
                                    <form action="{{ route('frontend.package.download',$package->package_id) }}" method="POST">
                                        @csrf
                                        {{-- اینجا لیست فایل‌ها را هم ارسال می‌کنیم --}}
                                        @foreach($package_file_list as $file)
                                            <input type="hidden" name="files[]" value="{{ $file->file_id }}">
                                        @endforeach
                                        <button type="submit" class="btn btn-primary btn-lg shadow-sm px-4">
                                            <i class="bi bi-download me-1"></i> دانلود پکیج
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('frontend.plan.buy') }}" class="btn btn-success btn-lg shadow-sm px-4">
                                        <i class="bi bi-bag-plus me-1"></i> خرید پلن
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- فایل‌های پکیج --}}
            <h3 class="text-center text-muted mt-5">
                لیست فایل‌های مرتبط با پکیج:
                <span class="badge bg-success">{{ $package->package_title }}</span>
            </h3>
            <div class="row mt-4">
                @foreach ($package_file_list as $list)
                    @php
                        $sizelist = (int) $list->file_size;
                        $readable = number_format($sizelist / 1048576, 2) . ' MB';
                        $imageUrl = $list->visibility === 'public'
                            ? asset('storage/' . $list->path)
                            : route('frontend.package.preview', $list->file_id);
                    @endphp
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow">
                            <img src="{{ $imageUrl }}" class="card-img-top rounded-top-4" alt="{{ $list->file_title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $list->file_title }}</h5>
                                <p class="card-text text-muted small">{{ $list->file_description }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center">
                                    <strong class="me-2">فرمت:</strong>
                                    @switch($list->file_type)
                                        @case('pdf')
                                            <i class="bi bi-filetype-pdf fs-4 text-danger"></i>
                                            @break
                                        @case('doc')
                                            <i class="bi bi-filetype-doc fs-4 text-primary"></i>
                                            @break
                                        @case('image/jpg')
                                        @case('image/png')
                                        @case('image/jpeg')
                                            <i class="bi bi-image fs-4 text-success"></i>
                                            @break
                                        @default
                                            <i class="bi bi-file-earmark fs-4 text-secondary"></i>
                                    @endswitch
                                </li>
                                <li class="list-group-item">
                                    <strong>حجم:</strong> {{ $readable }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
@endsection