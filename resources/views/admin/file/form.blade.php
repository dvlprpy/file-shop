<div id="errorContainer">
    @include('admin.partials.errors')
</div>

<div class="container mt-3" style="padding: 0;">
    <h4 class="file-heading-class mb-3">
        {{ $file->exists ? 'ویرایش فایل' : 'ایجاد فایل' }}
    </h4>

    <form action="{{ $file->exists ? route('file.update', $file->file_id) : route('file.store') }}"
          method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if ($file->exists)
            @method('PUT')
        @endif

        {{-- File Title --}}
        <div class="row mb-3">
            <label for="file_title" class="col-sm-2 col-form-label">عنوان فایل</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="file_title" id="file_title"
                       placeholder="لطفا نام یا عنوان فایل را وارد کنید."
                       value="{{ old('file_title', $file->file_title) }}">
            </div>
        </div>

        {{-- File Description --}}
        <div class="row mb-3">
            <label for="file_description" class="col-sm-2 col-form-label">توضیحات فایل</label>
            <div class="col-sm-10">
                <textarea name="file_description" class="form-control" id="file_description" rows="6"
                          placeholder="لطفا توضیحاتی درباره فایل بنویسید.">{{ old('file_description', $file->file_description) }}</textarea>
            </div>
        </div>

        {{-- File Upload --}}
        <div class="row mb-3">
            <label for="your_file" class="col-sm-2 col-form-label">آپلود فایل</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="your_file" id="your_file">
            </div>
        </div>

        {{-- Visibility --}}
        <div class="row mb-3">
            <label for="visibility" class="col-sm-2 col-form-label">نوع فایل</label>
            <div class="col-sm-10">
                <select class="form-select" id="visibility" name="visibility">
                    <option value="private" {{ old('visibility', $file->visibility) === 'private' ? 'selected' : '' }}>
                        فایل خصوصی
                    </option>
                    <option value="public" {{ old('visibility', $file->visibility) === 'public' ? 'selected' : '' }}>
                        فایل عمومی
                    </option>
                </select>
            </div>
        </div>

        {{-- File Category --}}
        {{-- <div class="row mb-3">
            <label for="file_category" class="col-sm-2 col-form-label">انتخاب دسته بندی فایل</label>
            <div class="col-sm-10">
                <select class="form-select" id="file_category" name="file_category">
                    <option value="0" {{ old('file_category', $file->file_category) == 0 ? 'selected' : '' }}>
                        بدون دسته بندی
                    </option>
                    @foreach ($category as $category_item)
                        <option value="{{ $category_item->category_id }}"
                                {{ old('file_category', $file->file_category) == $category_item->category_id ? 'selected' : '' }}>
                            {{ $category_item->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div> --}}

        <div class="row mb-3">
            <label for="file_category" class="col-sm-2 col-form-label">انتخاب دسته بندی فایل</label>
            <div class="col-sm-10">
                <select class="form-select select2" id="file_category" name="file_category[]" multiple="multiple">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->category_id }}"
                            {{ in_array($cat->category_id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $cat->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-25" style="display: block; margin: 5px auto;">
            {{ $file->exists ? 'ذخیره فایل' : 'ثبت فایل جدید' }}
        </button>
    </form>
</div>