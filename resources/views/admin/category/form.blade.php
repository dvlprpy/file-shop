    
    
    <div id="errorContainer">
            @include('admin.partials.errors')
    </div>

    
<div class="container mt-3" style="padding: 0;">
    <h4 class="file-heading-class mb-3">
        {{
            isset($categoryEdit) ? 'ویرایش دسته بندی' : 'ایجاد دسته بندی';
        }}
    </h4>
    <form action="{{ isset($categoryEdit) ? route('category.update', $categoryEdit->category_id) : route('category.store')  }}" method="POST" novalidate>

        @csrf
        @if (isset($categoryEdit))
            @method('PUT')
        @endif


        {{-- category_name --}}
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">عنوان دسته بندی</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="category_name" id="inputEmail3" placeholder="لطفا نام یا عنوان دسته بندی را وارد کنید." value="{{ old('category_name', isset($categoryEdit) ? $categoryEdit->category_name : '') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-success w-25" style="display: block; margin: 5px auto;">
            {{
                isset($categoryEdit) ? 'ذخیره دسته بندی' : 'ثبت دسته بندی جدید';
            }}
        </button>

    
    </form>
</div>