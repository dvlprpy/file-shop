@extends('layouts.admin')


@section('content')

    @error('packages')
            <div style="color:red;">{{ $message }}</div>
    @enderror


    <div class="container mt-4">
        <h3 class="mb-4">انتخاب پکیج های مرتبط با کاربر: <span class="text-primary">{{ $get_user_info->fullname }}</span></h3>

        <form action="{{ route('admin.user.updateSelectPackage', $get_user_info->user_id) }}" method="POST">
            @csrf

            <div class="card p-3 mb-3">
                <label class="form-label fw-bold mb-2">لطفا فایل‌های مورد نظر خود را انتخاب کنید:</label>
                <div class="row g-2" style="max-height: 400px; overflow-y: auto;">
                    @foreach($get_all_package as $package)
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check card p-2 h-100">
                                <div class="d-flex flex-row justify-content-evenly align-items-center mb-3 mt-3">
                                    <input class="form-check-input" type="checkbox" value="{{ $package->package_id  }}" name="packages[]"
                                    id="package{{ $package->package_id }}"
                                    {{ $get_user_info->packages->contains($package->package_id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="package{{ $package->package_id }}">
                                        {{ $package->package_title }}
                                    </label>
                                </div>

                                <small class="text-muted d-block mt-2 text-center">قیمت: {{ number_format($package->package_price) }}$</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-lg">به‌روزرسانی پکیج ها</button>
            </div>
        </form>
    </div>
    
@endsection