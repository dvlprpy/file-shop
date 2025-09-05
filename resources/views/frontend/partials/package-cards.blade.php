@foreach ($packages as $package)
<div class="col-md-4 mb-4 d-flex">
    <div class="card card-3d h-100 flex-fill border-success text-center">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $package->package_title }}</h5>
            <p class="card-text flex-grow-1 text-truncate" style="max-height: 60px;">{{ \Illuminate\Support\Str::limit($package->package_description, 80) }}</p>
            <p><strong>قیمت:</strong> {{ number_format($package->package_price) }} تومان</p>
            <a href="{{ route('frontend.package.detail', $package->package_id) }}" class="btn btn-3d btn-outline-success mt-auto">
                <i class="bi bi-info-square"></i> جزئیات
            </a>
        </div>
    </div>
</div>
@endforeach
