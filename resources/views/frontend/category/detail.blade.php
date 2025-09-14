@extends('layouts.home')

@section('content')

    {{-- Files --}}
    <div class="row mt-5" id="file-list">
        <h4 class="text-center mb-4 w-100">
            لیست فایل های مرتبط با دسته بندی: 
            <span class='text-primary'>{{$category_item->category_name}}</span>
        </h4>
        @forelse ($file as $category_file)
            <div class="col-md-4 mb-4 d-flex">
                <div class="card card-3d h-100 flex-fill">
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title">{{ $category_file->file_title }}</h5>
                        <p class="card-text flex-grow-1 text-truncate" style="max-height: 60px;">
                            {{ \Illuminate\Support\Str::limit($category_file->file_description, 80) }}
                        </p>
                        <p>
                            نوع:
                            @switch($category_file->file_type)
                                @case('pdf') 
                                    <i class="bi bi-filetype-pdf fs-4 text-danger" data-bs-toggle="tooltip" data-bs-title="PDF"></i> 
                                    @break
                                @case('doc') 
                                    <i class="bi bi-filetype-doc fs-4 text-primary" data-bs-toggle="tooltip" data-bs-title="Word Document"></i> 
                                    @break
                                @case('image/jpg')
                                @case('image/png')
                                @case('image/jpeg') 
                                    <i class="bi bi-image fs-4 text-success" data-bs-toggle="tooltip" data-bs-title="Image"></i> 
                                    @break
                                @default 
                                    <i class="bi bi-file-earmark fs-4 text-secondary" data-bs-toggle="tooltip" data-bs-title="Other File"></i>
                            @endswitch
                        </p>
                        <a href="{{ route('frontend.file.detail', $category_file->file_id) }}" class="btn btn-3d btn-outline-primary btn-sm mt-auto">
                            <i class="bi bi-info-square"></i> جزئیات
                        </a>
                    </div>
                </div>
            </div>
        @empty
            @include('frontend.no-item')
        @endforelse
    </div>


    {{-- Packages --}}
    <div class="row mt-5" id="package-list">
        <h4 class="text-center mb-4 w-100">
            لیست پکیج های مرتبط با دسته بندی: 
            <span class='text-primary'>{{$category_item->category_name}}</span>
        </h4>
        @forelse ($package as $package)
            <div class="col-md-4 mb-4 d-flex">
                <div class="card card-3d h-100 flex-fill border-success">
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title">{{ $package->package_title }}</h5>
                        <p class="card-text flex-grow-1 text-truncate" style="max-height: 60px;">
                            {{ \Illuminate\Support\Str::limit($package->package_description, 80) }}
                        </p>
                        <p><strong>قیمت:</strong> {{ number_format($package->package_price) }} تومان</p>
                        <a href="{{ route('frontend.package.detail', $package->package_id) }}" class="btn btn-3d btn-outline-success btn-sm mt-auto">
                            <i class="bi bi-info-square"></i> جزئیات
                        </a>
                    </div>
                </div>
            </div>
        @empty
            @include('frontend.no-item')
        @endforelse
    </div>
    
@endsection