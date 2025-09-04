@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">انتخاب فایل‌های مرتبط با پکیج: <span class="text-primary">{{ $package->package_title }}</span></h3>

    <form action="{{ route('package.updateSyncFile', $package->package_id) }}" method="POST">
        @csrf

        <div class="card p-3 mb-3">
            <label class="form-label fw-bold mb-2">لطفا فایل‌های مورد نظر خود را انتخاب کنید:</label>
            <div class="row g-2" style="max-height: 400px; overflow-y: auto;">
                @foreach($files as $file)
                <div class="col-md-6 col-lg-4">
                    <div class="form-check card p-2 h-100">
                        <input class="form-check-input" type="checkbox" value="{{ $file->file_id }}" name="file_ids[]"
                            id="file{{ $file->file_id }}"
                            {{ $package->files->contains($file->file_id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="file{{ $file->file_id }}">
                            {{ $file->file_title }}
                        </label>
                        <small class="text-muted d-block">نوع: {{ $file->visibility }}</small>
                        <small class="text-muted d-block">حجم: {{ number_format($file->file_size / 1024, 2) }} KB</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success btn-lg">به‌روزرسانی فایل‌ها</button>
        </div>
    </form>
</div>
@endsection