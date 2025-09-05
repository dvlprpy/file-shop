<div class="row mt-5" id="file-list">
    <h4 class="text-center mb-4 w-100">لیست فایل‌ها</h4>
    @forelse ($files as $file)
        <div class="col-md-4 mb-4 d-flex">
            <div class="card card-3d h-100 flex-fill">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">{{ $file->file_title }}</h5>
                    <p class="card-text flex-grow-1 text-truncate" style="max-height: 60px;">
                        {{ \Illuminate\Support\Str::limit($file->file_description, 80) }}
                    </p>
                    <p>
                        نوع:
                        @switch($file->file_type)
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
                    <a href="{{ route('frontend.file.detail', $file->file_id) }}" class="btn btn-3d btn-outline-primary btn-sm mt-auto">
                        <i class="bi bi-info-square"></i> جزئیات
                    </a>
                </div>
            </div>
        </div>
    @empty
        @include('frontend.no-item')
    @endforelse
</div>

@if($files->hasMorePages())
    <div class="d-flex justify-content-center mt-3 w-100">
        <button id="load-more-files" class="btn btn-outline-primary" data-page="2">مشاهده بیشتر فایل‌ها</button>
    </div>
@endif

    <div class="row mt-5" id="package-list">
        <h4 class="text-center mb-4 w-100">لیست پکیج‌ها</h4>
        @forelse ($packages as $package)
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

@if($packages->hasMorePages())
<div class="d-flex justify-content-center mt-3 w-100">
    <button id="load-more-packages" class="btn btn-outline-success" data-page="2">مشاهده بیشتر پکیج‌ها</button>
</div>
@endif

{{-- استایل کارت و دکمه 3D --}}
<style>
    .card-3d {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .card-3d:hover {
        transform: perspective(1000px) rotateY(5deg) rotateX(5deg) scale(1.03);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    .btn-3d {
        transition: all 0.2s ease-in-out;
        border-radius: 10px;
    }
    .btn-3d:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }
    .btn-3d:active {
        transform: translateY(2px);
        box-shadow: inset 0 3px 5px rgba(0,0,0,0.2);
    }
</style>

{{-- JS برای Load More --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function loadMore(button, containerId, url) {
            button.addEventListener('click', function(){
                let page = this.dataset.page;
                fetch(`${url}?page=${page}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById(containerId).insertAdjacentHTML('beforeend', data.html);
                        if(data.next_page) this.dataset.page = data.next_page;
                        else this.remove();
                    });
            });
        }

        const fileBtn = document.getElementById('load-more-files');
        if(fileBtn) loadMore(fileBtn, 'file-list', '{{ route('frontend.files.load_more') }}');

        const packageBtn = document.getElementById('load-more-packages');
        if(packageBtn) loadMore(packageBtn, 'package-list', '{{ route('frontend.packages.load_more') }}');
    });
</script>
