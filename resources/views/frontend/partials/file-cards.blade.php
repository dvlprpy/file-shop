@foreach ($files as $file)
<div class="col-md-4 mb-4 d-flex">
    <div class="card card-3d h-100 flex-fill text-center">
        <div class="card-body d-flex flex-column">
            <img src="{{ $file->thumbnail_url }}" class="mb-3 rounded" style="height:120px; object-fit:cover">
            <h5 class="card-title">{{ $file->file_title }}</h5>
            <p class="card-text flex-grow-1 text-truncate" style="max-height: 60px;">{{ \Illuminate\Support\Str::limit($file->file_description, 80) }}</p>
            <a href="{{ route('frontend.file.detail', $file->file_id) }}" class="btn btn-3d btn-outline-primary mt-auto">
                <i class="bi bi-info-square"></i> جزئیات
            </a>
        </div>
    </div>
</div>
@endforeach
