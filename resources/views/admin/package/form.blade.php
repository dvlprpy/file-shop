<div id="errorContainer">
    @include('admin.partials.errors')
</div>

<div class="container mt-3" style="padding: 0;">
    <h4 class="file-heading-class mb-3">
        {{ $package->exists ? 'ویرایش پکیج' : 'ایجاد پکیج' }}
    </h4>

    <form action="{{ $package->exists ? route('package.update', $package->package_id) : route('package.store') }}" method="POST" novalidate>
        @csrf
        @if ($package->exists)
            @method('PUT')
        @endif

        {{-- package_title --}}
        <div class="row mb-3">
            <label for="package_title" class="col-sm-2 col-form-label">عنوان پکیج</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="package_title" id="package_title"
                       placeholder="لطفا نام یا عنوان پکیج را وارد کنید."
                       value="{{ old('package_title', $package->package_title) }}">
            </div>
        </div>

        {{-- package_description --}}
        <div class="row mb-3">
            <label for="package_description" class="col-sm-2 col-form-label">توضیحات پکیج</label>
            <div class="col-sm-10">
                <textarea name="package_description" class="form-control" id="package_description" rows="6"
                          placeholder="لطفا توضیحاتی درباره پکیج بنویسید.">{{ old('package_description', $package->package_description) }}</textarea>
            </div>
        </div>

        {{-- package_price --}}
        <div class="row mb-3">
            <label for="package_price" class="col-sm-2 col-form-label">قیمت پکیج</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="package_price" id="package_price"
                       placeholder="لطفا قیمت پکیج را وارد کنید."
                       value="{{ old('package_price', $package->package_price) }}">
            </div>
        </div>

        {{-- package_category --}}
        <div class="row mb-3">
            <label for="package_category" class="col-sm-2 col-form-label">انتخاب دسته بندی پکیج</label>
            <div class="col-sm-10">
                <select class="form-select select2" multiple id="package_category" name="package_category[]">
                    @foreach ($category as $category_item)
                        <option value="{{ $category_item->category_id }}"
                                {{ in_array($category_item->category_id, old('package_category', $selectedPackages ?? []))? 'selected' : '' }}>
                            {{ $category_item->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-25" style="display: block; margin: 5px auto;">
            {{ $package->exists ? 'ذخیره پکیج' : 'ثبت پکیج جدید' }}
        </button>
    </form>
</div>
